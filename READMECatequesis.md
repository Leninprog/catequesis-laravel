# Catequesis Laravel

Sistema de gestión de catequesis para administrar personas, condiciones, eventos, evaluadores e inscripciones.

---

## Tecnologías

- PHP 8.1+
- Laravel 10
- MySQL / MariaDB
- Blade Templates
- Laravel Breeze

---

## Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/Leninprog/catequesis-laravel.git
cd catequesis-laravel

# 2. Instalar dependencias
composer install
npm install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate

# 4. Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=core_intervencion_social
DB_USERNAME=root
DB_PASSWORD=

# 5. Ejecutar migraciones
php artisan migrate

# 6. Levantar el servidor
npm run dev
php artisan serve
```

El sistema estará disponible en `http://localhost:8000`

---

## Nota sobre autenticación

Laravel Breeze ya está instalado en este proyecto. Estos comandos **solo se corren si se configura desde cero**, no al clonar el repo:

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run dev
php artisan migrate
```

---

## Rutas principales

| Módulo | URL |
|---|---|
| Personas | `/persons` |
| Categorías | `/categories` |
| Subcategorías | `/subcategories` |
| Condiciones | `/person-conditions` |
| Seguimientos | `/condition-followups` |
| Evaluadores | `/evaluators` |
| Eventos | `/events` |
| Objetivos de evento | `/event-targets` |
| Evaluadores de evento | `/event-evaluators` |
| Inscripciones | `/enrollments` |
| Asistencias | `/attendances` |

---

## Links

- **Repositorio:** https://github.com/Leninprog/catequesis-laravel
- **Deploy:** https://earlobe-sleet-silenced.ngrok-free.dev

---

## Autor

Lenin Arevalo

## Contacto: 

nicolasgar2@outlook.com
