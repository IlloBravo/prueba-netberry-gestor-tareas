#!/bin/bash

echo "🚀 Iniciando configuración del Gestor de Tareas..."

# Comprobamos si Docker está instalado
if ! command -v docker &> /dev/null
then
    echo "❌ Docker no está instalado. Instalándolo es la opción recomendada."
    echo "Si quieres ejecutar sin Docker, usa 'php artisan serve' y configura tu base de datos en .env."
    exit 1
fi

# Instalamos dependencias con Composer
echo "📦 Instalando dependencias con Composer..."
composer install --no-interaction --prefer-dist

# Generamos la clave de aplicación de Laravel
echo "🔑 Generando clave de aplicación..."
php artisan key:generate

# Comprobamos si Sail ya está instalado
if [ ! -f "vendor/bin/sail" ]; then
    echo "🔄 Instalando Laravel Sail..."
    composer require laravel/sail --dev
fi

# Levantamos los contenedores con Sail
echo "🐳 Levantando los contenedores de Docker..."
./vendor/bin/sail up -d

# Ejecutamos las migraciones y seeders
echo "⏳ Esperando a que MySQL esté listo..."
sleep 10
echo "🛠️ Ejecutando migraciones y seeders..."
./vendor/bin/sail artisan migrate:fresh --seed

# Mostramos la URL final
echo "✅ Configuración completada. Accede a la aplicación en:"
echo "🔗 http://localhost"
