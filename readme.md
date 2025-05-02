# Restaurant Management System

Aplikasi ini dibuat untuk memudahkan pengguna dalam mengelola restoran, seperti mengelola menu, mengelola stok, mengelola transaksi, dan lain-lain.

## Fitur

* Mengelola menu
* Mengelola stok
* Mengelola transaksi
* Mengelola user
* Mengelola role
* Laporan transaksi
* Laporan stok
* Laporan keuangan
* Pembelian menu
* Client Mengelola menu yang di simpan / cart
* Profile pada pengguna maupun staff

## Instalasi

1. Clone repository ini
2. Jalankan laragon/xampp (apache & mysql)
3. Collision database harus utf8mb4_general_ci
4. domain address harus http://localhost/ (karena pada pembuatan ini ada yang menggunakan xampp yang dimana domain addressnya http://localhost/ dan pada laragon bisa saja custom domain address seperti restaurant.test jadi jika ingin menggunakan custom domain address maka tinggal ubah-ubah saja import path nya)
5. Jalankan.

## Username dan Password

- Admin

  1. id : 11, password: 12345
- Client

  1. email: tarzan@gmail.com, password: 12345
  2. email: giga@gmail.com, password: 12345

## Halaman Login

- Admin
  /admin/login.php atau /admin/ saja jika belum login
- Client
  /login/ atau klik saja button "Login" yang ada pada navbar maupun sidebar versi android

## Konfigurasi

Ada dua konfigurasi, yaitu database untuk bagian admin dan ada juga untuk bagian client nya. Konfigurasi admin menggunakan database yang ada di folder admin/conf/ dan client menggunakan database yang ada di folder conf/config.php untuk isi variable nya dan juga untuk conf/connection.php untuk koneksi nya seperti mysqli_connect() nya yang akan digunakan nanti
