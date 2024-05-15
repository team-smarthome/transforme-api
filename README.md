# SIRAM DEV BE

## Pastikan anda punya versi PHP 8.2 ke atas

## Pastikan anda menjalankan server mysql di port 3306 serta user root tanpa password 

## Pastikan anda sudah menginstall composer

## Jika belum ada database bernama siram-be, silahkan buat database tersebut


### Cara Install
```bash
$ git clone
$ cd siram-be
$ composer install
```

### Cara Menyiapkan Environment
```bash
buat file .env yang berisi salinan dari .env.example
pastikan konfigurasi database sudah benar : 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siram-be
DB_USERNAME=root
DB_PASSWORD=

```