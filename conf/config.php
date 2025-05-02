<?php
// $host = 'localhost';
// $user = 'root';
// $password = '';
// $database = 'db_restaurant';

  

// $url = parse_url(getenv("JAWSDB_URL"));

// $host = $url["host"];
// $user = $url["user"];
// $password = $url["pass"];
// $database = substr($url["path"], 1);


$host = "qbct6vwi8q648mrn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$user = "r08984kixrtyjv3n";
$password = "r5maqqq1zlachlwh";
$database = "ihdds4a8erfv6vp4";

$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}