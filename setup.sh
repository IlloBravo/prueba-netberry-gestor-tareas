#!/bin/bash

echo "🚀 Iniciando configuración del Gestor de Tareas..."

if (! docker info > /dev/null 2>&1); then
    echo "⚠️ Docker está instalado pero no está en ejecución."
    echo "🔄 Por favor, inicia Docker y vuelve a ejecutar este script."
    exit 1
fi

echo "📦 Instalando dependencias con Composer..."
composer install --no-interaction --prefer-dist

if [ ! -f ".env" ]; then
    echo "⚙️ Creando el archivo .env desde .env.example..."
    cp .env.example .env
    echo "✅ Archivo .env generado correctamente."
fi

echo "🔑 Generando clave de aplicación..."
php artisan key:generate

echo "🐳 Levantando los contenedores de Docker..."
./vendor/bin/sail up -d

echo "⏳ Esperando a que MySQL esté listo..."
sleep 10
echo "🛠️ Ejecutando migraciones y seeders..."
./vendor/bin/sail artisan migrate:fresh --seed

echo "🧪 Ejecutando tests..."
./vendor/bin/sail test --coverage-html=public/coverage

echo "✅ Configuración completada. Accede a la aplicación en:"
echo "🔗 http://localhost"
echo "📊 Reporte de coverage disponible en: http://localhost/coverage/index.html"
