# ETAIRLINES - Recolección de datos

Sistema Laravel 9 + Livewire 2 para recolectar datos de interesados, enviar por correo un pase de abordaje estilo ETAIRLINES y administrar/exportar registros y contactos.

## Requisitos

- PHP 8.0.2 o superior
- Composer
- MySQL/MariaDB
- Extensiones PHP habituales de Laravel: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `zip`, `gd` o `imagick` si se agregan imágenes procesadas
- Node.js solo si se desea recompilar assets. Este proyecto usa CSS público simple y no requiere compilar para funcionar.

## Instalación

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configurar base de datos y correo en `.env`.

```bash
php artisan migrate --seed
php artisan storage:link
php artisan optimize:clear
```

El seeder crea un usuario administrador con las variables:

```env
ADMIN_NAME="Administrador ETAI"
ADMIN_EMAIL="admin@etai.local"
ADMIN_PASSWORD="password"
```

Cambiar esos valores antes de ejecutar `php artisan migrate --seed` en producción.

## Acceso

Formulario público:

```text
/
```

Panel administrativo:

```text
/dashboard
```

Login:

```text
/login
```

## Correos y colas

El sistema usa Jobs para enviar el correo del pase de abordaje sin bloquear el formulario.

En `.env`:

```env
QUEUE_CONNECTION=database
```

Ejecutar worker:

```bash
php artisan queue:work --tries=3 --timeout=120 --sleep=3
```

En producción dejar este worker como servicio persistente con Supervisor, systemd o la herramienta del servidor.

Ejemplo Supervisor:

```ini
[program:etairlines-worker]
command=php /ruta/proyecto/artisan queue:work --tries=3 --timeout=120 --sleep=3
directory=/ruta/proyecto
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
redirect_stderr=true
stdout_logfile=/var/log/etairlines-worker.log
```

## Variables de correo

Ejemplo para Mailpit/Mailhog local:

```env
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="info@etai.ac.cr"
MAIL_FROM_NAME="ETAirlines"
```

En producción configurar el SMTP institucional.

## Exportaciones

Desde el panel administrativo se puede descargar:

- Registros completos
- Contactos

Las exportaciones usan `maatwebsite/excel`.

## Mantenimiento de producción

Después de cambios de configuración o despliegue:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Permisos requeridos de escritura:

```text
storage/
bootstrap/cache/
```

## Estructura principal

```text
app/Http/Livewire/Public/EtairlinesForm.php
app/Http/Livewire/Admin/Dashboard/EtairlinesRegistrationsTable.php
app/Jobs/SendEtairlinesBoardingPassMailJob.php
app/Mail/EtairlinesBoardingPassMail.php
app/Exports/EtairlinesRegistrationsExport.php
app/Exports/EtairlinesContactsExport.php
resources/views/mail/etairlines-boarding-pass.blade.php
resources/views/livewire/public/etairlines-form.blade.php
resources/views/livewire/admin/dashboard/etairlines-registrations-table.blade.php
```
