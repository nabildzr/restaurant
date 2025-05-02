<?php
session_start();
require_once __DIR__ . '/../conf/function.php';

if (isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];
    $memberId = $_SESSION['memberId'];

    if (deleteCart($memberId, $itemId) > 0) {
        // $_SERVER['HTTP_REFERER'] adalah variabel global yang berisi URL dari halaman sebelumnya
        // Jika gagal menghapus item dari cart, maka akan di redirect ke halaman sebelumnya dengan parameter cart_deleted=0
        // Parameter cart_deleted=0 ini akan menampilkan alert gagal menghapus item dari cart
        // Untuk mengetahui apakah URL sebelumnya memiliki parameter '?' atau tidak, maka kita menggunakan fungsi strpos()
        // Fungsi strpos() digunakan untuk mencari posisi dari needle (parameter kedua) dalam haystack (parameter pertama)
        // Jika needle tidak ditemukan dalam haystack maka fungsi strpos() akan mengembalikan nilai -1
        // Jika needle ditemukan dalam haystack maka fungsi strpos() akan mengembalikan nilai posisi dari needle tersebut
        // Dalam hal ini kita menggunakan fungsi strpos() untuk mencari posisi dari '?' dalam $_SERVER['HTTP_REFERER']
        // Jika '?' tidak ditemukan maka akan di redirect ke halaman sebelumnya dengan parameter cart_deleted=0
        // Contoh: jika halaman sebelumnya adalah http://localhost/cart/, maka akan di redirect ke 
        // http://localhost/cart/?cart_deleted=0
        // Parameter cart_deleted=0 ini akan menampilkan alert gagal menghapus item dari cart
        // Jika '?' ditemukan maka akan di redirect ke halaman sebelumnya dengan parameter cart_deleted=0 yang di tambahkan di belakang parameter lainnya
        // Contoh: jika halaman sebelumnya adalah http://localhost/cart/?page=2, maka akan di redirect ke 
        // http://localhost/cart/?page=2&cart_deleted=0
        // Parameter cart_deleted=0 ini akan menampilkan alert gagal menghapus item dari cart
        header('location: ' . $_SERVER['HTTP_REFERER'] . (strpos($_SERVER['HTTP_REFERER'], '?') > -1 ? '&' : '?') . 'cart_deleted=1');
    } else {
        header('location: ' . $_SERVER['HTTP_REFERER'] . (strpos($_SERVER['HTTP_REFERER'], '?') > -1 ? '&' : '?') . 'cart_deleted=0');
    }
} else {
    header('location: ' . $_SERVER['HTTP_REFERER']);
}
