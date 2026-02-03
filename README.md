# FinanTech

Aplicação web baseada em Laravel para gestão financeira.

## Requisitos

- PHP 8.1+ (extensões comuns do Laravel: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath)
- Composer
- Node.js 18+ e npm
- Banco de dados (MySQL, PostgreSQL ou SQLite)

### Dependências opcionais

- Redis (cache/filas)
- Mailhog/Mailtrap (testes de e-mail)
- S3/MinIO (armazenamento de arquivos)

## Instalação

1. Instale as dependências PHP:
   ```bash
   composer install
   ```

2. Instale as dependências do front-end:
   ```bash
   npm install
   ```

3. Copie o arquivo de ambiente:
   ```bash
   cp .env.example .env
   ```

4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

5. Configure o banco de dados no `.env`.

6. Execute as migrações:
   ```bash
   php artisan migrate
   ```

7. (Opcional) Rode os seeders:
   ```bash
   php artisan db:seed
   ```

8. Compile os assets do front-end:
   ```bash
   npm run build
   ```

9. Inicie o servidor local:
   ```bash
   php artisan serve
   ```

## Variáveis essenciais do `.env`

Exemplo mínimo recomendado:

```env
APP_NAME=FinanTech
APP_ENV=local
APP_KEY=base64:CHAVE_GERADA
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finantech
DB_USERNAME=root
DB_PASSWORD=secret

LOG_CHANNEL=stack
```

### Variáveis opcionais comuns

```env
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=nao-responder@finantech.local
MAIL_FROM_NAME="FinanTech"

FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=chave
AWS_SECRET_ACCESS_KEY=segredo
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=finantech
AWS_ENDPOINT=http://localhost:9000
```

## Comandos úteis (Artisan)

```bash
php artisan serve
php artisan route:list
php artisan config:clear
php artisan cache:clear
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed
php artisan queue:work
```
