<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

Dibuat Dengan 💖 Oleh Sofa Ramadhan, Menggunakan ilmu tenaga dalam

## Screenshot Project

![Screenshot 2025-01-29 050048](https://github.com/user-attachments/assets/2140385c-75b4-4ace-a033-23726b516a1b)

![Screenshot 2025-01-29 050110](https://github.com/user-attachments/assets/7ca84de4-0959-4be6-ae72-0a17cd99914a)

![Screenshot 2025-01-29 050125](https://github.com/user-attachments/assets/930a03d3-2b5f-4ab6-8145-874debd692f9)

![Screenshot 2025-01-29 050134](https://github.com/user-attachments/assets/be24400a-892f-4dc2-b766-b602cdc1dc1f)

![Screenshot 2025-01-29 050143](https://github.com/user-attachments/assets/10c18f08-8ecb-48b7-b54f-77fd9f30bbd1)

## Action

![Screenshot 2025-01-29 050613](https://github.com/user-attachments/assets/9e28e378-34bf-4cc4-a7df-35e077c5ce8c)

![Screenshot 2025-01-29 050600](https://github.com/user-attachments/assets/dc54c529-c7a5-4e36-b90a-010c7e7c5992)

![Screenshot 2025-01-29 050626](https://github.com/user-attachments/assets/f7ab52e0-75e3-461d-b6d6-89b7fb21aa99)

## Installation

### Prerequisites

Before you begin, ensure you have the following installed on your system:

- PHP >= 8.0
- Composer
- MySQL or any other supported database
- Web server (Apache, Nginx, etc.)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/mangsopa/crud-menu-laravel.git starter-laravel
   cd starter-laravel
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Copy the `.env` file**
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Configure the `.env` file**
   Open the `.env` file and set your database credentials and other environment variables:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=adms
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run the migrations**
   ```bash
   php artisan migrate
   ```

7. **Serve the application**
   ```bash
   php artisan serve
   ```
