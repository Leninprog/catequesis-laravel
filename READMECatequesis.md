//Instalacion del entorno
composer install
npm install

//opcional para el .env para configuraciones, se copia el .env.example y se configura las conexiones
comando: cp .env.example .env

//crear la clave de seguridad del proyecto
php artisan key:generate

//migraciones
php artisan migrate

//correr en local host
php artisan serve

//rutas son de acuerdo a las views y definir routes web.php
.../estudiantes

// comandos para la autenticacion, solo se corre una vez, los anteriores comandos si cada que se trae el repo
composer require laravel/breeze --dev 
php artisan breeze:install blade
npm install && npm run dev
php artisan migrate