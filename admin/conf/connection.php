<?php

$host = 'localhost';
$user = 'root';
$password = '';

$database = 'db_restaurant';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("db not connected" . mysqli_connect_error());
}
    