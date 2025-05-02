<?php 

require 'config.php';

if ($conn->ping()) {
  echo "Koneksi ke database berhasil!";
} else {
  echo "Koneksi gagal: " . $conn->connect_error;
}