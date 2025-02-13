# Prueba técnica Netberry Solutions - Gestor de Tareas

Aplicación web para gestionar tareas con categorías, desarrollada en Laravel, para la prueba técnica de Netberry Solutions, con soporte para Docker y configuración sin Docker.

## Requisitos previos

Antes de iniciar la aplicación, asegúrate de tener instalado:

- [Docker](https://www.docker.com/) instalado y en ejecución.
- [Composer](https://getcomposer.org/) instalado.
- PHP 8.4+
- MySQL 8+

## Instalación y Configuración

```bash
  bash setup.sh
```

Este script instalará las dependencias, levantará los contenedores y ejecutará las migraciones y seeders automáticamente.
Lanzará los tests y desde consola podrás ver la url para acceder a la prueba y al coverage de los tests generados.

## Estructura del Proyecto

- **routes/**: Definición de rutas de la aplicación.
- **app/Http/**: Controladores.
- **app/Services/**: Servicios encargados de la lógica de la aplicación.
- **resources/views/**: Vistas Blade de la aplicación.
- **public/**: Archivos accesibles públicamente (favicon, imágenes, CSS, JS).
- **database/migrations/**: Migraciones para la base de datos.
- **database/seeders/**: Datos iniciales de prueba.
- **setup.sh**: Script de instalación automática.

## Uso

- **Añadir tarea**: Introduce el nombre y selecciona categorías, luego haz clic en "Añadir".
- **Eliminar tarea**: Haz clic en el botón "X" junto a la tarea.
- **Lista de tareas vacía**: Se mostrará un mensaje si no hay tareas creadas.
- **Validaciones**: Se mostrarán validaciones diferentes usadas en caso de crear una tarea con el mismo nombre.

## Contacto

Si tienes dudas o problemas con la configuración, por favor, ponte en contacto conmigo en bravodearcedavid@gmail.com.

---
