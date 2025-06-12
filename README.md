<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

## Tentang Aplikasi

Ini adalah **Aplikasi Point of Sale (POS)** yang dibangun menggunakan Laravel. Aplikasi ini masih dalam tahap pengembangan dan **belum sepenuhnya selesai**. Tujuannya adalah untuk menyediakan sistem penjualan sederhana yang dapat digunakan oleh pelaku usaha kecil hingga menengah.

Fitur yang direncanakan antara lain:

-   Manajemen Produk
-   Transaksi Pembelian
-   Transaksi Penjualan
-   Daftar Member
-   Cetak Struk
-   Riwayat Transaksi
-   Laporan Penjualan

> ⚠️ Saat ini aplikasi masih dalam pengembangan awal dan belum siap untuk digunakan dalam produksi.

## Teknologi yang Digunakan

-   Laravel Framework
-   Blade Template Engine
-   Bootstrap
-   MySQL

## Instalasi Lokal

```bash
git clone https://github.com/username/nama-repo-pos.git
cd nama-repo-pos
composer install
cp .env.example .env
php artisan key:generate
# lalu atur konfigurasi database di file .env
php artisan migrate
php artisan serve
```

## Kontribusi

Kontribusi sangat terbuka! Jika kamu ingin membantu menyempurnakan aplikasi ini, silakan fork repo ini dan buat pull request.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
