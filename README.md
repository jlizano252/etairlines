# ETAirlines

Sistema de recoleccion de datos, desarrollado con Laravel 9 + Livewire.

---

# Requisitos

- PHP 8.2 o superior
- Composer
- MySQL / MariaDB
- Node.js (solo para compilar assets)
- Servidor web (Apache o Nginx)

---

# Instalación

Instalar dependencias:

```bash
composer install
```

Crear el archivo `.env` a partir de `.env.example` y configurar al menos:

```env
APP_NAME=ETAirlines
APP_ENV=production
APP_DEBUG=false
APP_URL=https://dominio.com

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

Generar la llave de la aplicación:

```bash
php artisan key:generate
```

---

# Base de datos

Ejecutar las migraciones:

```bash
php artisan migrate --force
```

Se requiere cargar datos iniciales:

```bash
php artisan db:seed --force
```

---

# Permisos

Asegurar permisos de escritura sobre:

```
storage/
bootstrap/cache/
```

---

# Queue Worker (Obligatorio)

El envío de correos y procesos en segundo plano utilizan **Laravel Queues**.

Mantener un worker ejecutándose permanentemente:

```bash
php artisan queue:work --tries=3 --timeout=120
```

Se recomienda administrarlo mediante **Supervisor**, **systemd** o un servicio equivalente.

---

# Verificación

Comprobar que:

- La aplicación carga correctamente.
- La conexión a la base de datos funciona.
- El SMTP envía correos.
- El Queue Worker está procesando trabajos.
- No existen registros pendientes en `failed_jobs`.

---

# Comandos útiles

```bash
php artisan optimize
php artisan optimize:clear
php artisan queue:work
php artisan migrate 
```
