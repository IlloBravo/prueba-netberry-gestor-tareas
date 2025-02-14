const { execSync } = require("child_process");
const fs = require("fs");

function runCommand(command) {
    try {
        console.log(`⏳ Ejecutando: ${command}`);
        execSync(command, { stdio: "inherit" });
    } catch (error) {
        console.error(`❌ Error ejecutando: ${command}`);
        process.exit(1);
    }
}

console.log("🚀 Iniciando configuración del Gestor de Tareas...");

if (!fs.existsSync(".env")) {
    console.log("📂 Creando archivo .env...");
    fs.copyFileSync(".env.example", ".env");
}

console.log("📦 Instalando dependencias con Composer...");
runCommand("composer install --no-interaction --prefer-dist");

console.log("🔑 Generando clave de aplicación...");
runCommand("php artisan key:generate");

console.log("🛠️ Ejecutando migraciones y seeders...");
runCommand("php artisan migrate:fresh --seed");

console.log("🧪 Ejecutando tests...");
runCommand("php artisan test");

console.log("✅ Configuración completada. Accede a la aplicación en:");
console.log("🔗 http://localhost");
