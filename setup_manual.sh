#!/bin/bash

echo "🚀 Iniciando configuración manual del Gestor de Tareas..."

echo "🔍 Comprobando el estado de MySQL..."
if ! systemctl is-active --quiet mysql; then
    echo "❌ No se puede continuar sin MySQL. Inicia MySQL manualmente y vuelve a ejecutar este script."
    exit 1
else
    echo "✅ MySQL ya está en ejecución."
fi

echo "📂 Creando archivo .env desde .env.manual..."
cp .env.manual .env
echo "✅ Archivo .env generado correctamente."

echo "📦 Instalando dependencias con Composer..."
composer install --no-interaction --prefer-dist

echo "🔑 Generando clave de aplicación..."
php artisan key:generate

echo "🛠️ Ejecutando migraciones y seeders..."
php artisan migrate:fresh --seed

echo "🧪 Ejecutando tests..."
php artisan test

echo "✅ Levantando el entorno..."
php artisan serve
