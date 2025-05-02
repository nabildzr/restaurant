<?php
// $host = 'localhost';
// $user = 'root';
// $password = '';
// $database = 'db_restaurant';

  

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$host = $url["host"];
$user = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);
