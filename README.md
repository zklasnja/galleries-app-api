<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to run the app

Clone the repo to the desired directory.
Position terminal in that direcory.
Run the command:

```
composer install
```

Then run the command:

```
npm install
```

Next step would be to create a local database named `galleries_app_be`.

Create `.env` file by running a command in the terminal:

```
cp .env.example .env
```

Check the correct password for the database in `.env` file.

Run commands in the terminal:

```
php artisan key:generate
php artisan migrate:install
php artisan migrate
php artisan db:seed
php artisan jwt:secret
php artisan serve
```
