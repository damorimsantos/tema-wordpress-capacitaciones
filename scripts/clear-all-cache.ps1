<#
.SYNOPSIS
    Limpa cache em 3 camadas da Hashtag Capacitaciones: WP Rocket, Cloudways (Varnish) e Cloudflare.

.DESCRIPTION
    - WP Rocket : via SSH/wp-cli na prod (usa a senha ja em .vscode/sftp.json, atraves de .vscode/remote_ops.py).
    - Cloudways : API v1 -> service/varnish action=purge (full-page cache do servidor).
    - Cloudflare: API v4 -> zones/{id}/purge_cache {"purge_everything":true}.

    Todos os secrets vem do 1Password via `op` em runtime. Nada de credencial em texto plano no disco.

    Item esperado no 1Password (campos do tipo password/text):
        cloudways_email   -> e-mail de login da conta Cloudways
        cloudways_apikey  -> API Key (Account -> API Key)
        cloudflare_token  -> API Token (perm. Zone.Cache Purge + Zone.Read na zona do site)

    OBS capacitaciones: se a conta Cloudways for a mesma do hashtag, o item
    `hashtag-cache-purge` ja serve para Cloudways (o server e achado pelo sys_user
    `sfsesufegv`). Para o Cloudflare, o token precisa ter permissao TAMBEM na zona
    `hashtagcapacitaciones.com` — se o token atual so cobre `hashtagtreinamentos.com`,
    use um item/token proprio via -Item / -ZoneName.

.PARAMETER Targets
    Quais camadas limpar: all (default) | rocket | cloudways | cloudflare. Aceita lista.

.PARAMETER Vault
    Vault do 1Password onde mora o item (default: Employee).

.PARAMETER Account
    Conta 1Password (shorthand/url) usada pelo op (default: hashtagtreinamentos.1password.com).

.PARAMETER Item
    Titulo do item no 1Password (default: hashtag-cache-purge).

.PARAMETER ZoneName
    Dominio raiz no Cloudflare para descobrir o zone_id (default: hashtagcapacitaciones.com).

.PARAMETER CloudwaysAppUser
    sys_user do app no Cloudways, usado para localizar o server_id (default: sfsesufegv).

.EXAMPLE
    pwsh -File clear-all-cache.ps1
    pwsh -File clear-all-cache.ps1 -Targets cloudflare,cloudways
#>
[CmdletBinding()]
param(
    [ValidateSet('all', 'rocket', 'cloudways', 'cloudflare')]
    [string[]]$Targets = @('all'),
    [string]$Vault = 'Employee',
    [string]$Account = 'hashtagtreinamentos.1password.com',
    [string]$Item = 'hashtag-cache-purge',
    [string]$ZoneName = 'hashtagcapacitaciones.com',
    [string]$CloudwaysAppUser = 'sfsesufegv'
)

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'
[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12

$wantAll = $Targets -contains 'all'
function Want([string]$t) { return ($wantAll -or ($Targets -contains $t)) }

$results = [ordered]@{}

# --------------------------------------------------------------------------
# Helpers
# --------------------------------------------------------------------------
function Find-ProjectRoot {
    $dir = $PSScriptRoot
    while ($dir) {
        if (Test-Path (Join-Path $dir '.vscode\remote_ops.py')) { return $dir }
        $parent = Split-Path $dir -Parent
        if ($parent -eq $dir) { break }
        $dir = $parent
    }
    throw "Nao localizei a raiz do projeto (.vscode/remote_ops.py) subindo de $PSScriptRoot"
}

function Get-PythonExe {
    # Stubs em WindowsApps (Store) nao servem; o `py -0p` lista os Pythons reais.
    $cands = New-Object System.Collections.Generic.List[string]
    try {
        $pyLauncher = Get-Command py -ErrorAction SilentlyContinue
        if ($pyLauncher) {
            foreach ($line in (& $pyLauncher.Source -0p 2>$null)) {
                if ($line -match '([A-Za-z]:\\[^\s].*?python\.exe)') { $cands.Add($Matches[1]) }
            }
        }
    }
    catch {}
    foreach ($c in 'python', 'python3') {
        foreach ($g in (Get-Command $c -All -ErrorAction SilentlyContinue)) {
            if ($g.Source -and $g.Source -notmatch 'WindowsApps') { $cands.Add($g.Source) }
        }
    }
    foreach ($p in @(
            "$env:LOCALAPPDATA\Python\pythoncore-*\python.exe",
            "$env:LOCALAPPDATA\Programs\Python\Python3*\python.exe",
            "$env:ProgramFiles\Python3*\python.exe")) {
        Get-ChildItem -Path $p -ErrorAction SilentlyContinue | ForEach-Object { $cands.Add($_.FullName) }
    }
    foreach ($exe in ($cands | Select-Object -Unique)) {
        & $exe -c "import paramiko" 2>$null
        if ($LASTEXITCODE -eq 0) { return $exe }
    }
    throw "Nenhum Python com paramiko encontrado. Instale com: py -m pip install --user paramiko"
}

function Get-Secret([string]$field) {
    if (-not (Get-Command op -ErrorAction SilentlyContinue)) {
        throw "1Password CLI (op) nao encontrado no PATH."
    }
    $ref = "op://$Vault/$Item/$field"
    $val = & op read --account $Account $ref 2>$null
    if ($LASTEXITCODE -ne 0 -or [string]::IsNullOrWhiteSpace($val)) {
        throw "op read falhou para '$ref'. op autenticado? item/campo existem nesse vault?"
    }
    return ($val | Out-String).Trim()
}

# --------------------------------------------------------------------------
# 1) WP ROCKET  (SSH -> wp-cli eval)
# --------------------------------------------------------------------------
if (Want 'rocket') {
    Write-Host "`n[1/3] WP Rocket - limpando via SSH/wp-cli..." -ForegroundColor Cyan
    try {
        $root = Find-ProjectRoot
        $py = Get-PythonExe
        $remoteOps = Join-Path $root '.vscode\remote_ops.py'
        $remoteCmd = "cd applications/$CloudwaysAppUser/public_html && wp eval 'rocket_clean_domain(); rocket_clean_minify();' && echo ROCKET_OK"
        # stderr remoto traz PHP warnings inofensivos; com EAP=Stop o 2>&1 viraria NativeCommandError.
        $eap = $ErrorActionPreference; $ErrorActionPreference = 'Continue'
        $out = (& $py $remoteOps exec $remoteCmd 2>&1 | Out-String)
        $rc = $LASTEXITCODE
        $ErrorActionPreference = $eap
        if ($rc -eq 0 -and $out -match 'ROCKET_OK') {
            $results['WP Rocket'] = 'OK'
            Write-Host "      OK (rocket_clean_domain + rocket_clean_minify)" -ForegroundColor Green
        }
        else {
            throw ("rc=$rc; saida: " + ($out.Trim()))
        }
    }
    catch {
        $results['WP Rocket'] = "FALHA: $($_.Exception.Message)"
        Write-Warning "WP Rocket: $($_.Exception.Message)"
    }
}

# --------------------------------------------------------------------------
# 2) CLOUDWAYS  (API v1 -> service/varnish purge)
# --------------------------------------------------------------------------
if (Want 'cloudways') {
    Write-Host "`n[2/3] Cloudways - purge Varnish via API..." -ForegroundColor Cyan
    try {
        $cwEmail = Get-Secret 'cloudways_email'
        $cwKey = Get-Secret 'cloudways_apikey'

        $tok = Invoke-RestMethod -Method Post -Uri 'https://api.cloudways.com/api/v1/oauth/access_token' `
            -Body @{ email = $cwEmail; api_key = $cwKey }
        $auth = @{ Authorization = "Bearer $($tok.access_token)" }

        # Localizar o server_id pelo sys_user do app
        $servers = Invoke-RestMethod -Method Get -Uri 'https://api.cloudways.com/api/v1/server' -Headers $auth
        $serverId = $null
        foreach ($srv in $servers.servers) {
            foreach ($app in $srv.apps) {
                if ($app.sys_user -eq $CloudwaysAppUser) { $serverId = $srv.id; break }
            }
            if ($serverId) { break }
        }
        if (-not $serverId) { throw "nao achei server com app sys_user='$CloudwaysAppUser'." }

        $null = Invoke-RestMethod -Method Post -Uri 'https://api.cloudways.com/api/v1/service/varnish' `
            -Headers $auth -Body @{ server_id = $serverId; action = 'purge' }

        $results['Cloudways'] = "OK (server_id=$serverId)"
        Write-Host "      OK - Varnish purgado (server_id=$serverId)" -ForegroundColor Green
    }
    catch {
        $results['Cloudways'] = "FALHA: $($_.Exception.Message)"
        Write-Warning "Cloudways: $($_.Exception.Message)"
    }
}

# --------------------------------------------------------------------------
# 3) CLOUDFLARE  (API v4 -> purge_everything)
# --------------------------------------------------------------------------
if (Want 'cloudflare') {
    Write-Host "`n[3/3] Cloudflare - purge everything via API..." -ForegroundColor Cyan
    try {
        $cfToken = Get-Secret 'cloudflare_token'
        $cfAuth = @{ Authorization = "Bearer $cfToken" }

        $zones = Invoke-RestMethod -Method Get -Headers $cfAuth `
            -Uri "https://api.cloudflare.com/client/v4/zones?name=$ZoneName&status=active"
        if (-not $zones.success -or $zones.result.Count -lt 1) {
            throw "nao achei a zona '$ZoneName' (token tem Zone.Read nessa zona?)."
        }
        $zoneId = $zones.result[0].id

        $resp = Invoke-RestMethod -Method Post -Headers $cfAuth -ContentType 'application/json' `
            -Uri "https://api.cloudflare.com/client/v4/zones/$zoneId/purge_cache" `
            -Body (@{ purge_everything = $true } | ConvertTo-Json)

        if (-not $resp.success) { throw ($resp.errors | ConvertTo-Json -Compress) }
        $results['Cloudflare'] = "OK (zone_id=$zoneId)"
        Write-Host "      OK - purge everything (zone_id=$zoneId)" -ForegroundColor Green
    }
    catch {
        $results['Cloudflare'] = "FALHA: $($_.Exception.Message)"
        Write-Warning "Cloudflare: $($_.Exception.Message)"
    }
}

# --------------------------------------------------------------------------
# Resumo
# --------------------------------------------------------------------------
Write-Host "`n===== Resumo =====" -ForegroundColor Cyan
$failed = $false
foreach ($k in $results.Keys) {
    $v = $results[$k]
    if ($v -like 'OK*') {
        Write-Host ("  {0,-12} {1}" -f $k, $v) -ForegroundColor Green
    }
    else {
        Write-Host ("  {0,-12} {1}" -f $k, $v) -ForegroundColor Red
        $failed = $true
    }
}
if ($failed) { exit 1 }
