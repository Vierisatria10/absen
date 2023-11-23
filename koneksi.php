<?php
// Informasi koneksi ke basis data
$host = "localhost"; // Lokasi server database (biasanya "localhost")
$username = "root"; // Nama pengguna basis data
$password = ""; // Kata sandi pengguna basis data
$database = "absensi"; // Nama basis data yang akan digunakan

// Membuat koneksi ke basis data
$conn = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi ke basis data gagal: " . mysqli_connect_error());
}
?>
