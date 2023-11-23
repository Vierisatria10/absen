<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi.php Anda

$query = "SELECT id FROM tmprfid LIMIT 1"; // Mengambil satu ID dari tmprfid
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row); // Mengembalikan ID sebagai respons JSON
} else {
    echo json_encode(['id' => null]); // Mengembalikan ID null jika tidak ada data
}
