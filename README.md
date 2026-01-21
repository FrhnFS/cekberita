# CekBerita (Cek Hoaks Jabar)

Website layanan publik cek berita hoaks untuk kebutuhan Kerja Praktik Diskominfo Jawa Barat.

## Fitur
- Landing page informatif
- Daftar artikel hoaks
- Detail artikel hoaks
- Login admin sederhana
- CRUD artikel hoaks + upload gambar
- Halaman laporan hoax (kontak pelaporan)

## Teknologi
- Laravel 12
- Blade Template
- MySQL

## Setup singkat
1. Copy `.env` dan sesuaikan koneksi database.
2. Jalankan migrasi dan seeder:
   - `php artisan migrate`
   - `php artisan db:seed`
3. Jalankan symlink storage:
   - `php artisan storage:link`
4. Jalankan aplikasi:
   - `php artisan serve`

## Login admin default
- Email: `admin@diskominfo.jabar.go.id`
- Password: `admin123`
