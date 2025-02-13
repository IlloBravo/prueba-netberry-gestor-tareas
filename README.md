<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Prueba técnica Netberry Solutions - Gestor de Tareas

Aplicación web para gestionar tareas con categorías, desarrollada en Laravel, para la prueba técnica de Netberry Solutions, con soporte para Docker y configuración sin Docker.

## Requisitos previos

Antes de iniciar la aplicación, asegúrate de tener instalado:

- PHP 8.4+
- Composer
- MySQL 8+
- Opcional: Docker y Laravel Sail (para la ejecución con contenedores)

## Instalación y Configuración

### Opción 1: Uso con Docker (Recomendado)

Si tienes **Docker instalado**, simplemente ejecuta el siguiente comando:

```bash
  bash setup.sh
```

Este script instalará las dependencias, levantará los contenedores y ejecutará las migraciones y seeders automáticamente.

Accede a la aplicación en: [http://localhost](http://localhost)

### Opción 2: Uso sin Docker

Si **no tienes Docker**, el script configurará automáticamente tu entorno local.

Esto instalará las dependencias, configurará `.env`, creará la base de datos y ejecutará las migraciones y seeders.

Accede a la aplicación en: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Estructura del Proyecto

- **routes/**: Definición de rutas de la aplicación.
- **app/Http/**: Controladores.
- **resources/views/**: Vistas Blade de la aplicación.
- **public/**: Archivos accesibles públicamente (favicon, imágenes, CSS, JS).
- **database/migrations/**: Migraciones para la base de datos.
- **database/seeders/**: Datos iniciales de prueba.
- **setup.sh**: Script de instalación automática.

## Uso

- **Añadir tarea**: Introduce el nombre y selecciona categorías, luego haz clic en "Añadir".
- **Eliminar tarea**: Haz clic en el botón "X" junto a la tarea.
- **Lista de tareas vacía**: Se mostrará un mensaje si no hay tareas creadas.

## Contacto

Si tienes dudas o problemas con la configuración, por favor, ponte en contacto conmigo en bravodearcedavid@gmail.com.

---
