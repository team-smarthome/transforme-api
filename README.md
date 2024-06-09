# SIRAM DEV BE

## Pastikan anda punya versi PHP  Minimal 8.2 atau yang terbaru

## Pastikan anda menjalankan server mysql di port 3306 serta user root dengan password root

## Pastikan anda sudah menginstall composer

## Jika belum ada database bernama db_siram, silahkan buat database tersebut

### Jangan lupa setiap kali ingin mengerjakan selalu pull branch development-stagging

```bash
git pull origin development-stagging
```

### Jangan lupa setiap kali ingin mengerjakan selalu pull dari branch development-stagging-v2
```bash
git pull origin development-stagging-v2
```
### Cara Install dan menggunakannya

```bash
$ git clone
$ cd siram-be
$ composer install
$ php artisan migrate (ini untuk membuat table-table yang diperlukan, tergantung kebutuhan ya)
```

### Cara Menyiapkan Environment

```bash
buat file .env yang berisi salinan dari .env.example
$ php artisan key:generate
pastikan konfigurasi database sudah benar :
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_siram
DB_USERNAME=root
DB_PASSWORD=

```
