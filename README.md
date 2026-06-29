# ETAirlines

Sistema de inscripción, Test Vocacional y Agendamiento de Matrícula desarrollado con Laravel y Livewire.

---

# Requisitos del proyecto

- PHP 8.2+
- Composer
- MySQL
- Node.js (solo para compilación de assets)
- Laravel Scheduler
- Laravel Queue Worker

---

# Instalación

Clonar el proyecto.

```bash
composer install
```

Instalar dependencias de frontend.

```bash
npm install
npm run build
```

Crear el archivo `.env` y configurar las variables correspondientes.

Generar la llave de la aplicación.

```bash
php artisan key:generate
```

Ejecutar las migraciones.

```bash
php artisan migrate --force
```

Si se desea crear el usuario administrador inicial:

```bash
php artisan db:seed
```

---

# Variables importantes del .env

## Aplicación

```env
APP_NAME=ETAirlines
APP_ENV=production
APP_DEBUG=false
APP_URL=https://dominio.com
```

---

## Base de datos

```env
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

---

## Cola de trabajos

El sistema depende de Jobs para el envío de correos.

```env
QUEUE_CONNECTION=database
```

Verificar la existencia de las tablas:

- jobs
- failed_jobs

---

## Correo

Configurar el SMTP correspondiente.

```env
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

---

## Usuario administrador

Si se utiliza el Seeder incluido:

```env
ADMIN_NAME=
ADMIN_EMAIL=
ADMIN_PASSWORD=
```

---

# Comandos posteriores al despliegue

Optimizar Laravel.

```bash
php artisan optimize
```

Limpiar cachés si fuese necesario.

```bash
php artisan optimize:clear
```

Crear el enlace de almacenamiento.

```bash
php artisan storage:link
```

---

# Queue Worker

El sistema utiliza Jobs para:

- Envío del correo de resultados del Test Vocacional.
- Envío del pase de abordaje.
- Envío del correo de cita de matrícula.
- Recordatorios automáticos de citas.

Debe mantenerse un worker ejecutándose permanentemente.

```bash
php artisan queue:work
```

Se recomienda administrarlo mediante Supervisor o un servicio equivalente.

---

# Scheduler

El sistema utiliza el Scheduler de Laravel para ejecutar tareas automáticas.

Debe existir el cron correspondiente.

```bash
* * * * * php /ruta/proyecto/artisan schedule:run >> /dev/null 2>&1
```

---

# Almacenamiento

Los archivos cargados por el administrador se almacenan utilizando el disco configurado en Laravel.

Verificar que exista:

```env
FILESYSTEM_DISK=public
```

y ejecutar:

```bash
php artisan storage:link
```

---

# Permisos

Asegurar permisos de escritura sobre:

```
storage/
bootstrap/cache/
```

---

# Funcionalidades automáticas

El sistema realiza automáticamente:

- Registro de estudiantes.
- Procesamiento del Test Vocacional.
- Cálculo de afinidades por carrera.
- Generación de resultados.
- Envío de correos mediante Jobs.
- Agendamiento y reprogramación de citas.
- Recordatorios automáticos de matrícula.
- Exportación de información a Excel.

---

# Consideraciones

- Nunca ejecutar el sistema utilizando `QUEUE_CONNECTION=sync` en producción.
- Mantener siempre activo el Queue Worker.
- Mantener activo el Scheduler de Laravel.
- Configurar correctamente `APP_URL`, ya que las URLs firmadas utilizadas en los correos dependen de esta variable.
- Verificar la correcta configuración del servidor SMTP antes de habilitar el acceso público.

---

# Verificación recomendada

Después del despliegue validar:

- Registro de un estudiante.
- Generación correcta de resultados.
- Envío de correo de resultados.
- Envío del pase de abordaje.
- Agendamiento de una cita.
- Envío del correo de confirmación de cita.
- Procesamiento correcto de los Jobs.
- Ejecución del Scheduler.
- Exportación de registros desde el panel administrativo.
