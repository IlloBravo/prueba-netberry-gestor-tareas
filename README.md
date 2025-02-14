# 📝 Prueba técnica Netberry Solutions - Gestor de Tareas

Aplicación web para gestionar tareas con categorías, desarrollada en Laravel, para la prueba técnica de Netberry Solutions.

---

## 🚀 Opciones para probar el repositorio

Elige la opción que mejor se adapte a tu entorno aunque necesitarás requisitos obligatorios:

- PHP 8.4+
- MySQL 8+
- [Composer](https://getcomposer.org/) instalado.

---

## 🔹 **Opción 1: Linux con Docker (Recomendada)**
> **Para sistemas Linux o entornos con WSL en Windows.**

### **🔧 Requisitos previos**
- [Docker](https://www.docker.com/) instalado y en ejecución.

### Instalación y Configuración

```bash
  bash setup.sh
```

📌 Este script ejecutará automáticamente: 
- ✅ Instalación de dependencias con Composer.
- ✅ Creará el fichero .env automáticamente.
- ✅ Generará la key para la aplicación.
- ✅ Levantará los contenedores con Docker y Laravel Sail.
- ✅ Ejecutará las migraciones y seeders.
- ✅ Lanzará los tests.
- ✅ Mostrará la URL de acceso a la aplicación y el coverage de tests.

---

## 🔹 **Opción 2: Sin Docker (Node.js)**
> **Para cualquier sistema operativo (Windows, Mac, Linux) sin necesidad de Docker.**

### **🔧 Requisitos previos**
- [Node.js](https://nodejs.org/) (Se usa para automatizar la configuración inicial).

### Instalación y Configuración

```bash
  node setup.js
```

📌 Este script ejecutará automáticamente: 
- ✅ Generará el fichero .env automáticamente.
- ✅ Instalación de dependencias con Composer.
- ✅ Generará la key para la aplicación.
- ✅ Ejecutará las migraciones y seeders.
- ✅ Lanzará los tests.
- ✅ Mostrará la URL de acceso a la aplicación.

---

## 🔹 **Opción 3: Instalación manual (Laravel)**
> **Para quienes prefieren configurar manualmente Laravel sin Docker ni Node.js.**

📌 Esta opción te permite mayor control sobre la configuración.
### Instalación y Configuración

### Clona el repositorio:
```bash
  git clone https://github.com/IlloBravo/prueba-netberry-gestor-tareas
  cd gestor-tareas
```

###  Instala las dependencias con Composer:
```bash
  composer install
```

###  Copia el archivo de configuración:
```bash
  cp .env.example .env
```

###  Genera la clave de Laravel:
```bash
  php artisan key:generate
```

###  Ejecuta las migraciones y seeders:
```bash
  php artisan migrate:fresh --seed
```

###  Inicia el servidor de Laravel manualmente:
```bash
  php artisan serve
```

###  Lanza los tests
```bash
  php artisan test
```

## Estructura del Proyecto

- **routes/**: Definición de rutas de la aplicación.
- **app/Http/**: Controladores.
- **app/Services/**: Servicios encargados de la lógica de la aplicación.
- **resources/views/**: Vistas Blade de la aplicación.
- **public/**: Archivos accesibles públicamente (favicon, imágenes, CSS, JS).
- **database/migrations/**: Migraciones para la base de datos.
- **database/seeders/**: Datos iniciales de prueba.
- **setup.sh**: Script de instalación automática con Docker.
- **setup.js**: Script de instalación automática sin Docker.

## Uso

- **Añadir tarea**: Introduce el nombre y selecciona categorías, luego haz clic en "Añadir".
- **Eliminar tarea**: Haz clic en el botón "X" junto a la tarea.
- **Lista de tareas vacía**: Se mostrará un mensaje si no hay tareas creadas.
- **Ordenación**: Puedes ordenar las tareas por ID, nombre o categorías.
- **Validaciones**: Se mostrarán validaciones diferentes usadas en caso de crear una tarea con el mismo nombre.

## Contacto

Si tienes dudas o problemas con la configuración, por favor, ponte en contacto conmigo en bravodearcedavid@gmail.com.

---
