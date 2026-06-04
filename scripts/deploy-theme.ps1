param(
    [string]$ConfigPath = "deploy/deploy.config.json",
    [switch]$Apply
)

Set-StrictMode -Version Latest
$ErrorActionPreference = "Stop"

function Get-ConfigValue {
    param(
        [Parameter(Mandatory = $true)]$Config,
        [Parameter(Mandatory = $true)][string]$Name,
        $Default = $null
    )

    $property = $Config.PSObject.Properties[$Name]
    if ($null -ne $property) {
        return $property.Value
    }

    return $Default
}

function Resolve-ProjectPath {
    param(
        [Parameter(Mandatory = $true)][string]$BasePath,
        [Parameter(Mandatory = $true)][string]$Candidate
    )

    if ([System.IO.Path]::IsPathRooted($Candidate)) {
        return (Resolve-Path -LiteralPath $Candidate).Path
    }

    return (Resolve-Path -LiteralPath (Join-Path $BasePath $Candidate)).Path
}

function Resolve-RelativeToConfigOrProject {
    param(
        [Parameter(Mandatory = $true)][string]$ProjectRoot,
        [Parameter(Mandatory = $true)][string]$ConfigDirectory,
        [Parameter(Mandatory = $true)][string]$Candidate
    )

    if ([System.IO.Path]::IsPathRooted($Candidate)) {
        return $Candidate
    }

    $configRelative = Join-Path $ConfigDirectory $Candidate
    if (Test-Path -LiteralPath $configRelative) {
        return $configRelative
    }

    return (Join-Path $ProjectRoot $Candidate)
}

function Remove-TrailingDirectorySeparator {
    param(
        [Parameter(Mandatory = $true)][string]$PathValue
    )

    $trimmed = $PathValue
    while ($trimmed.Length -gt 3 -and ($trimmed.EndsWith("\") -or $trimmed.EndsWith("/"))) {
        $trimmed = $trimmed.Substring(0, $trimmed.Length - 1)
    }

    return $trimmed
}

function Convert-ToRsyncLocalPath {
    param(
        [Parameter(Mandatory = $true)][string]$WindowsPath
    )

    $resolved = (Resolve-Path -LiteralPath $WindowsPath).Path
    return (Remove-TrailingDirectorySeparator -PathValue $resolved).Replace("\", "/") + "/"
}

function Convert-ToWslPath {
    param(
        [Parameter(Mandatory = $true)][string]$WindowsPath
    )

    $resolved = (Resolve-Path -LiteralPath $WindowsPath).Path
    $normalized = $resolved.Replace("\", "/")
    $drive = $normalized.Substring(0, 1).ToLowerInvariant()
    $tail = $normalized.Substring(2)
    return "/mnt/$drive$tail"
}

function Convert-ToCygwinPath {
    param(
        [Parameter(Mandatory = $true)][string]$WindowsPath
    )

    $resolved = (Resolve-Path -LiteralPath $WindowsPath).Path
    $normalized = $resolved.Replace("\", "/")
    $drive = $normalized.Substring(0, 1).ToLowerInvariant()
    $tail = $normalized.Substring(2)
    return "/cygdrive/$drive$tail"
}

function Get-WindowsShortPath {
    param(
        [Parameter(Mandatory = $true)][string]$PathValue
    )

    $resolved = (Resolve-Path -LiteralPath $PathValue).Path
    $fso = New-Object -ComObject Scripting.FileSystemObject
    return $fso.GetFile($resolved).ShortPath
}

function Quote-Bash {
    param(
        [Parameter(Mandatory = $true)][string]$Value
    )

    $replacement = "'" + '"' + "'" + '"' + "'"
    return "'" + $Value.Replace("'", $replacement) + "'"
}

function Resolve-RsyncBackend {
    param(
        [string]$Mode,
        [string]$ConfiguredPath
    )

    $normalizedMode = if ([string]::IsNullOrWhiteSpace($Mode)) { "auto" } else { $Mode.ToLowerInvariant() }

    if (-not [string]::IsNullOrWhiteSpace($ConfiguredPath)) {
        $expandedPath = [Environment]::ExpandEnvironmentVariables($ConfiguredPath)
        if (-not (Test-Path -LiteralPath $expandedPath)) {
            throw "O rsync configurado em rsyncPath nao foi encontrado: $expandedPath"
        }

        return @{
            Type = "native"
            Command = (Resolve-Path -LiteralPath $expandedPath).Path
        }
    }

    $nativeCommand = Get-Command rsync -ErrorAction SilentlyContinue
    if ($normalizedMode -in @("auto", "native") -and $null -ne $nativeCommand) {
        return @{
            Type = "native"
            Command = $nativeCommand.Source
        }
    }

    $gitRsync = "C:\Program Files\Git\usr\bin\rsync.exe"
    if ($normalizedMode -in @("auto", "native") -and (Test-Path -LiteralPath $gitRsync)) {
        return @{
            Type = "native"
            Command = $gitRsync
        }
    }

    $wslCommand = Get-Command wsl -ErrorAction SilentlyContinue
    if ($normalizedMode -in @("auto", "wsl") -and $null -ne $wslCommand) {
        return @{
            Type = "wsl"
            Command = $wslCommand.Source
        }
    }

    throw "Nenhum backend rsync foi encontrado. Instale rsync no PATH, informe rsyncPath ou use WSL com rsync."
}

function Test-IsCygwinRsync {
    param(
        [Parameter(Mandatory = $true)][string]$CommandPath
    )

    $normalized = $CommandPath.Replace("\", "/").ToLowerInvariant()
    return $normalized.Contains("/cygwin") -or $normalized.Contains("/rsync-win/")
}

$repoRoot = (Resolve-Path -LiteralPath (Join-Path $PSScriptRoot "..")).Path
$candidateConfigPath = if ([System.IO.Path]::IsPathRooted($ConfigPath)) { $ConfigPath } else { Join-Path $repoRoot $ConfigPath }
if (-not (Test-Path -LiteralPath $candidateConfigPath)) {
    throw "Arquivo de configuracao nao encontrado: $candidateConfigPath. Crie deploy/deploy.config.json a partir do arquivo de exemplo."
}

$resolvedConfigPath = (Resolve-Path -LiteralPath $candidateConfigPath).Path
$configDirectory = Split-Path -Parent $resolvedConfigPath

$config = Get-Content -Raw -LiteralPath $resolvedConfigPath | ConvertFrom-Json

$remoteHost = Get-ConfigValue -Config $config -Name "host"
$username = Get-ConfigValue -Config $config -Name "username"
$remotePath = Get-ConfigValue -Config $config -Name "remotePath"

if ([string]::IsNullOrWhiteSpace($remoteHost)) {
    throw "Preencha o campo host em deploy/deploy.config.json."
}

if ([string]::IsNullOrWhiteSpace($username)) {
    throw "Preencha o campo username em deploy/deploy.config.json."
}

if ([string]::IsNullOrWhiteSpace($remotePath)) {
    throw "Preencha o campo remotePath em deploy/deploy.config.json."
}

$port = [int](Get-ConfigValue -Config $config -Name "port" -Default 22)
$rsyncMode = [string](Get-ConfigValue -Config $config -Name "rsyncMode" -Default "auto")
$rsyncPath = [string](Get-ConfigValue -Config $config -Name "rsyncPath" -Default "")
$sshKeyPath = [string](Get-ConfigValue -Config $config -Name "sshKeyPath" -Default "")

$excludeFileCandidate = [string](Get-ConfigValue -Config $config -Name "excludeFile" -Default ".deployignore")
$excludeFile = Resolve-ProjectPath -BasePath $repoRoot -Candidate $excludeFileCandidate
$sourcePathCandidate = [string](Get-ConfigValue -Config $config -Name "sourcePath" -Default $repoRoot)
$sourcePath = Resolve-ProjectPath -BasePath $repoRoot -Candidate $sourcePathCandidate

if (-not [string]::IsNullOrWhiteSpace($sshKeyPath)) {
    $expandedKeyPath = [Environment]::ExpandEnvironmentVariables($sshKeyPath)
    $candidateKeyPath = Resolve-RelativeToConfigOrProject -ProjectRoot $repoRoot -ConfigDirectory $configDirectory -Candidate $expandedKeyPath
    if (-not (Test-Path -LiteralPath $candidateKeyPath)) {
        throw "Chave SSH nao encontrada: $candidateKeyPath"
    }

    $sshKeyPath = (Resolve-Path -LiteralPath $candidateKeyPath).Path
}

$backend = Resolve-RsyncBackend -Mode $rsyncMode -ConfiguredPath $rsyncPath
$sourceSpec = Convert-ToRsyncLocalPath -WindowsPath $sourcePath
$destinationSpec = "{0}@{1}:{2}/" -f $username, $remoteHost, $remotePath.TrimEnd("/")

$baseArgs = @(
    "--archive",
    "--omit-dir-times",
    "--no-perms",
    "--no-owner",
    "--no-group",
    "--compress",
    "--human-readable",
    "--itemize-changes",
    "--delete",
    "--delete-excluded",
    "--exclude-from=$excludeFile"
)

if (-not $Apply) {
    $baseArgs += "--dry-run"
}

Write-Host ""
Write-Host "Origem:      $sourceSpec"
Write-Host "Destino:     $destinationSpec"
Write-Host "ExcludeFile: $excludeFile"
Write-Host "Modo:        $($backend.Type)"
Write-Host "Execucao:    $(if ($Apply) { 'apply' } else { 'dry-run' })"
Write-Host ""

if ($backend.Type -eq "native") {
    $isCygwinRsync = Test-IsCygwinRsync -CommandPath $backend.Command
    $nativeExcludeFile = if ($isCygwinRsync) { Convert-ToCygwinPath -WindowsPath $excludeFile } else { $excludeFile }
    $nativeSourceSpec = if ($isCygwinRsync) { (Convert-ToCygwinPath -WindowsPath $sourcePath) + "/" } else { $sourceSpec }
    $sshExecutable = "ssh"
    if ($isCygwinRsync) {
        $cygwinSsh = Join-Path (Split-Path -Parent $backend.Command) "ssh.exe"
        if (Test-Path -LiteralPath $cygwinSsh) {
            $sshExecutable = Convert-ToCygwinPath -WindowsPath (Get-WindowsShortPath -PathValue $cygwinSsh)
        }
    }

    $sshParts = @($sshExecutable, "-p", "$port", "-o", "StrictHostKeyChecking=accept-new")
    if (-not [string]::IsNullOrWhiteSpace($sshKeyPath)) {
        $nativeKeyPath = if ($isCygwinRsync) { Convert-ToCygwinPath -WindowsPath (Get-WindowsShortPath -PathValue $sshKeyPath) } else { $sshKeyPath }
        $sshParts += @("-i", $nativeKeyPath)
    }

    $sshCommand = ($sshParts | ForEach-Object {
        if ($_ -match "\s") {
            '"' + ($_ -replace '"', '\"') + '"'
        }
        else {
            $_
        }
    }) -join " "

    $nativeArgs = @()
    foreach ($arg in $baseArgs) {
        if ($arg.StartsWith("--exclude-from=")) {
            $nativeArgs += "--exclude-from=$nativeExcludeFile"
        }
        else {
            $nativeArgs += $arg
        }
    }
    $nativeArgs += @("-e", $sshCommand, $nativeSourceSpec, $destinationSpec)

    & $backend.Command @nativeArgs
    if ($LASTEXITCODE -ne 0) {
        throw "O rsync retornou codigo $LASTEXITCODE."
    }

    exit 0
}

$wslExcludeFile = Convert-ToWslPath -WindowsPath $excludeFile
$wslSourcePath = (Convert-ToWslPath -WindowsPath $sourcePath).TrimEnd("/") + "/"
$wslSshParts = @("ssh", "-p", "$port", "-o", "StrictHostKeyChecking=accept-new")

if (-not [string]::IsNullOrWhiteSpace($sshKeyPath)) {
    $wslSshParts += @("-i", (Convert-ToWslPath -WindowsPath $sshKeyPath))
}

$wslSshCommand = $wslSshParts -join " "
$wslArgs = @(
    "rsync",
    "--archive",
    "--omit-dir-times",
    "--no-perms",
    "--no-owner",
    "--no-group",
    "--compress",
    "--human-readable",
    "--itemize-changes",
    "--delete",
    "--delete-excluded"
)

if (-not $Apply) {
    $wslArgs += "--dry-run"
}

$wslArgs += @(
    "--exclude-from=$wslExcludeFile",
    "-e",
    $wslSshCommand,
    $wslSourcePath,
    $destinationSpec
)

$shellCommand = ($wslArgs | ForEach-Object { Quote-Bash -Value $_ }) -join " "

& $backend.Command sh -lc $shellCommand
if ($LASTEXITCODE -ne 0) {
    throw "O rsync via WSL retornou codigo $LASTEXITCODE."
}
