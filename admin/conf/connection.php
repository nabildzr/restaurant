<?php


$host = "qbct6vwi8q648mrn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$user = "r08984kixrtyjv3n";
$password = "r5maqqq1zlachlwh";
$database = "ihdds4a8erfv6vp4";

$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
    