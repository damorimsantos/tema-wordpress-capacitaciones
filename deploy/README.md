# Deploy do tema via SSH

O fluxo recomendado para este tema e `rsync` via SSH com `--delete`, usando `--dry-run` por padrao para revisar o espelhamento antes de aplicar.

## 1. Preparar a configuracao local

Crie `deploy/deploy.config.json` a partir de `deploy/deploy.config.example.json`.

Campos:

- `host`: host SSH do servidor
- `port`: porta SSH
- `username`: usuario SSH
- `remotePath`: pasta exata do tema no servidor
- `sshKeyPath`: caminho local da chave privada SSH, opcional
- `rsyncMode`: `auto`, `native` ou `wsl`
- `rsyncPath`: opcional, caminho explicito para um binario `rsync.exe`

Observacoes:

- Prefira chave SSH. Nao grave senha no arquivo.
- Se voce usa alias no `~/.ssh/config`, pode apontar `host` para esse alias.
- Se `sshKeyPath` for relativo, ele pode apontar para um arquivo na mesma pasta do `deploy.config.json`, por exemplo `./key.ssh`.
- Esse arquivo precisa ser a chave privada. A chave publica e a que normalmente comeca com `ssh-ed25519` ou `ssh-rsa`.

## 2. Rodar o dry-run

```powershell
powershell -ExecutionPolicy Bypass -File .\scripts\deploy-theme.ps1
```

Ou:

```powershell
npm run deploy:dry-run
```

O script usa `--dry-run` por padrao e mostra inclusoes, alteracoes e exclusoes que aconteceriam no servidor.

## 3. Aplicar de verdade

```powershell
powershell -ExecutionPolicy Bypass -File .\scripts\deploy-theme.ps1 -Apply
```

Ou:

```powershell
npm run deploy:apply
```

## 4. Backend de rsync

O script tenta localizar `rsync` nesta ordem:

1. `rsyncPath` definido no arquivo de configuracao
2. `rsync` nativo no PATH
3. `C:\Program Files\Git\usr\bin\rsync.exe`
4. `wsl` com `rsync`

Se nenhum backend estiver disponivel, instale um destes:

- Git for Windows/MSYS2 com `rsync`
- cwRsync/DeltaCopy
- WSL com `rsync`
