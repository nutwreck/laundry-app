## Laundry App - API
API aplikasi manajemen bisnis laundry menggunakan laravel

## Requirements

- Docker
https://docs.docker.com/docker-for-windows/install/
- Composer
https://getcomposer.org/download/
- Code Editor
https://code.visualstudio.com/download
- Git
https://git-scm.com/downloads

## Tech Stacks

 - Laravel 8.51.0
 - Nginx:1.20
 - php:7.4.19-fpm

## Installation
 1. Git Clone
 `https://github.com/nutwreck/laundry-app.git` `--public repositories`
 2. Run Composer Install
 `composer install`
 3.  Copy .env.example to .env
 `cp .env.example .env`
 4. Generate Laravel Key
 `php artisan key:generate`
 5. Set Git Hook
 `php ./vendor/bin/grumphp git:pre-commit`
 6. Sesuaikan konfigurasi .env `--owner code candraajipamungkas@gmail.com`
 7. Generate JWT_SECRET dari sini (64 Length, 1 Number of Strings)
`http://www.unit-conversion.info/texttools/random-string-generator/`
 8. Run Migration
`php artisan migrate`
 9. Run Seeder
`php artisan db:seed`
 10. Build Docker
 `docker-compose up -d --build site`
 11. Access site
`http://localhost:8080/`

## Before Commit / Push
 1. Run composer lint untuk cek standarisasi code
   `composer lint`
 2. Run composer lint:fix jika ada error yang dapat diperbaiki secara otomatis, jika tidak ada langsung Push
   `composer lint:fix`
 3. Setelah selesai diperbaiki, jalankan git add kembali sebelum push
   `git add .`

Note : 
    - Pastikan selalu melihat anda sedang di branch mana sebelum Push
    - Template Pesan commit :
        - Add: (Jika menambahkan file)
            - ... (List file)
            - ... (List file)
        - Modify: (Jika mengupdate file)
            - ... (List file)
            - ... (List file)
        - Delete: (Jika delete file)
            - ... (List file)
            - ... (List file)
        - Fix: (Jika memperbaiki kesalahan modul)
            - ... (List file)
            - ... (List file)

## Port Docker
 - **nginx** - `:8080`
 - **mysql** - `:33061`
 - **redis** - `:63791`
## References
 - Code Quality GrumPHP w/ Ruleset PHPcs
 https://dev.to/adrmrn/how-i-take-care-of-code-quality-with-grumphp-4do5
 - Laravel Docker
 https://medium.com/@danairwanda/laravel-teknologi-virtualisasi-menggunakan-docker-f263a547a555
