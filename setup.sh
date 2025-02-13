#!/bin/bash

echo "🚀 Iniciando configuración del Gestor de Tareas..."

if ! command -v docker &> /dev/null
then
    echo "❌ Docker no está instalado. Ejecutando en modo manual con PHP y MySQL..."

        echo "📦 Instalando dependencias con Composer..."
        composer install --no-interaction --prefer-dist

        echo "🔑 Generando clave de aplicación..."
        php artisan key:generate

        echo "⚙️ Configurando .env automáticamente..."
        cp .env.example .env
        sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=mysql/' .env
        sed -i 's/DB_HOST=127.0.0.1/DB_HOST=127.0.0.1/' .env
        sed -i 's/DB_PORT=3306/DB_PORT=3306/' .env
        sed -i 's/DB_DATABASE=laravel/DB_DATABASE=gestor_tareas/' .env
        sed -i 's/DB_USERNAME=root/DB_USERNAME=gestor_user/' .env
        sed -i 's/DB_PASSWORD=/DB_PASSWORD=gestor_password/' .env

        echo "📂 Creando base de datos en MySQL..."
        mysql -u root -e "CREATE DATABASE IF NOT EXISTS gestor_tareas;"
        mysql -u root -e "CREATE USER IF NOT EXISTS 'gestor_user'@'localhost' IDENTIFIED BY 'gestor_password';"
        mysql -u root -e "GRANT ALL PRIVILEGES ON gestor_tareas.* TO 'gestor_user'@'localhost';"
        mysql -u root -e "FLUSH PRIVILEGES;"

        echo "🛠️ Ejecutando migraciones y seeders..."
        php artisan migrate:fresh --seed

        echo "🚀 Iniciando servidor de Laravel..."
        php artisan serve &

        echo "✅ Configuración completada. Accede a la aplicación en:"
        echo "🔗 http://127.0.0.1:8000"
        exit 0
fi

if (! docker info > /dev/null 2>&1); then
    echo "⚠️ Docker está instalado pero no está corriendo."
    echo "🔄 Por favor, inicia Docker y vuelve a ejecutar este script."
    exit 1
fi

echo "🐳 Docker detectado y en ejecución. Usando Laravel Sail..."

echo "📦 Instalando dependencias con Composer..."
composer install --no-interaction --prefer-dist

echo "🔑 Generando clave de aplicación..."
php artisan key:generate

if [ ! -f "vendor/bin/sail" ]; then
    echo "🔄 Instalando Laravel Sail..."
    composer require laravel/sail --dev
fi

echo "🐳 Levantando los contenedores de Docker..."
./vendor/bin/sail up -d

echo "⏳ Esperando a que MySQL esté listo..."
sleep 10
echo "🛠️ Ejecutando migraciones y seeders..."
./vendor/bin/sail artisan migrate:fresh --seed

echo "✅ Configuración completada. Accede a la aplicación en:"
echo "🔗 http://localhost"
