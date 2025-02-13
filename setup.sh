#!/bin/bash

echo "🚀 Iniciando configuración del Gestor de Tareas con Docker y Laravel Sail..."

# Verificar si Docker está en ejecución
if (! docker info > /dev/null 2>&1); then
    echo "❌ Docker no está en ejecución. Por favor, inícialo antes de ejecutar este script."
    exit 1
fi

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

echo "🧪 Ejecutando tests..."
./vendor/bin/sail artisan test --coverage-html=public/coverage

echo "✅ Configuración completada. Accede a la aplicación en:"
echo "🔗 http://localhost"
echo "📊 Reporte de coverage: http://localhost/coverage/index.html"
