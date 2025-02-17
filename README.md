# 📝 Prueba técnica Netberry Solutions - Gestor de Tareas

Aplicación web para gestionar tareas con categorías, desarrollada en Laravel, 
para la prueba técnica de Netberry Solutions.

---

## 🚀 Opciones para probar el repositorio

Elige la opción que mejor se adapte a tu entorno aunque necesitarás requisitos obligatorios:

- PHP 8.4+
- MySQL 8+
- [Composer](https://getcomposer.org/) instalado.

### Clona el repositorio:
```bash
  git clone https://github.com/IlloBravo/prueba-netberry-gestor-tareas
  cd prueba-netberry-gestor-tareas
```

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

- ✅ Creará el fichero .env automáticamente.
- ✅ Instalación de dependencias con Composer.
- ✅ Levantará los contenedores con Docker y Laravel Sail.
- ✅ Generará la key para la aplicación.
- ✅ Ejecutará las migraciones y seeders.
- ✅ Lanzará los tests.
- ✅ Mostrará la URL de acceso a la aplicación y el coverage de tests.

---

## 🔹 **Opción 2: Instalación manual (Laravel)**
> **Para quienes prefieren configurar manualmente Laravel sin Docker.**

### Instalación y Configuración

⚠️ **IMPORTANTE**: Para probar la instalación manual, **debes tener creada una base de datos llamada** `gestor_tareas` 
**y** `testing` **con el usuario** `sail` **y la contraseña** `password`.

Si no la tienes, créala antes de continuar.

```bash
  bash setup_manual.sh
```

- ✅ Creará el fichero .env automáticamente.
- ✅ Instalación de dependencias con Composer.
- ✅ Generará la key para la aplicación.
- ✅ Ejecutará las migraciones y seeders.
- ✅ Lanzará los tests.
- ✅ Mostrará la URL de acceso a la aplicación.

## Estructura del Proyecto

- **routes/**: Definición de rutas de la aplicación.
- **app/Exceptions/**: Carpeta contenedora de excepciones personalizadas para cada caso de uso.
- **app/Http/**: Controladores.
- **app/Models/**: Modelos usados para la prueba.
- **app/Services/**: Servicios encargados de la lógica de la aplicación.
- **database/factories/**: Factorías necesarias para facilitar los tests.
- **database/migrations/**: Migraciones para la base de datos.
- **database/seeders/**: Datos iniciales de prueba.
- **public/**: Archivos accesibles públicamente (favicon, imágenes, CSS, JS).
- **resources/views/**: Vistas Blade de la aplicación.
- **tests/**: Carpeta contenedora de los tests creados.
- **setup.sh**: Script de instalación automática con Docker.
- **setup.cjs**: Script de instalación automática sin Docker.

## Uso

- **Añadir tarea**: Introduce el nombre y selecciona categorías, luego haz clic en "Añadir".
- **Eliminar tarea**: Haz clic en el botón "X" junto a la tarea.
- **Lista de tareas vacía**: Se mostrará un mensaje si no hay tareas creadas.
- **Ordenación**: Puedes ordenar las tareas por ID, nombre o categorías.
- **Validaciones**: Se mostrarán validaciones diferentes usadas en caso de crear una tarea con el mismo nombre.

## Contacto

Si tienes dudas o problemas con la configuración, por favor, ponte en contacto conmigo en bravodearcedavid@gmail.com.

---
