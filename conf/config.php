<?php
// $host = 'localhost';
// $user = 'root';
// $password = '';
// $database = 'db_restaurant';

  

$url = parse_url(getenv("JAWSDB_URL"));

$host = $url["host"];
$user = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}