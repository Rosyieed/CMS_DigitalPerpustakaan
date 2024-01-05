# Digital Perpustakaan (CMS)
Assignment Magang MSIB6 Detik.com


## Features :
- Login
- Register
- Forgot Password
- Auth with Google
- CRUD Books
- CRUD Category
- Update Profile (Password, Username)
- Access Privileges are restricted to only open, view, edit, and delete Book Listings in accordance with the data created by the user themselves (except for administrators)
- Generate Data to Excel or PDF

# This project was built using :

## FrontEnd :
- HTML 5
- Bootstrap 4
- CSS 3
- JavaScript
- Sweetalert (https://realrashid.github.io/sweet-alert/)
- Trix Editor (https://trix-editor.org/)
- Larapex Chart (https://larapex-charts.netlify.app/)
- DomPDF (https://github.com/barryvdh/laravel-dompdf)
- Laravel Excel (https://laravel-excel.com/)

## BackEnd :
- Laravel Breeze (https://laravel.com/docs/10.x/starter-kits#laravel-breeze)
- Laravel Socialite (https://laravel.com/docs/10.x/socialite)

## Database :
- MySQL

## Settings
- Copy - Paste ENV Example, rename to .env, and set email configuration 
- change ";extension=gd" to "extension=gd" at php.ini file to use gd driver.

## Instalation & Run (download full .RAR with .env) :
```bash
- change ";extension=gd" to "extension=gd" at php.ini file to use gd driver.
- no need to copy env example to original env.
- php artisan migrate:fresh --seed
- php artisan serve
- npm run dev (for hot reload)
```

## Instalation & Run (git clone) :
```bash
- git clone https://github.com/Rosyieed/CMS_DigitalPerpustakaan.git 
- composer install or composer update (if ur php version under 8.2)
- npm install
- npm run build
- php artisan storage:link (for link storage to public)
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve
- npm run dev (for hot reload)
```
