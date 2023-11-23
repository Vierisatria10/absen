<?php
// Membuat koneksi ke database (Anda perlu mengganti informasi koneksi sesuai dengan database Anda)
include 'koneksi.php';

// Memeriksa apakah ada data dalam tabel tmp_rfid
$query = "SELECT COUNT(*) as jumlah_data FROM tmprfid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row['jumlah_data'] > 0) {
    echo 'ada_data';
} else {
    echo 'tidak_ada_data';
}

// Menutup koneksi ke database
mysqli_close($conn);
?>
