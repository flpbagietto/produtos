#!/bin/bash
set -e

echo "Aguardando MySQL estar pronto..."
until nc -z mysql 3306; do
    echo "MySQL não está pronto ainda. Aguardando..."
    sleep 2
done

echo "MySQL está pronto!"

if [ ! -f .env ]; then
    echo "Criando arquivo .env..."
    cat > .env << 'EOF'
APP_NAME="Sistema de Busca de Produtos"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8080
APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=estoque_db
DB_USERNAME=estoque_user
DB_PASSWORD=admin

SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
EOF
fi

echo "Instalando dependências do Composer..."
if [ ! -d vendor ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

echo "Gerando chave da aplicação..."
php artisan key:generate --force

echo "Aguardando MySQL aceitar conexões..."
sleep 5

echo "Executando migrations..."
php artisan migrate --force

echo "Executando seeders..."
php artisan db:seed --force

echo "Limpando caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "Aplicação pronta!"
exec php-fpm

