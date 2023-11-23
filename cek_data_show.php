<?php
include 'koneksi.php';

$response = ['total' => 0];

// Lakukan koneksi ke database
if ($conn) {
    $query = "SELECT COUNT(*) as total FROM tmprfid";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $response['total'] = $row['total'];
    } else {
        $response['error'] = 'Gagal menjalankan kueri: ' . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    $response['error'] = 'Gagal terhubung ke database';
}

header('Content-Type: application/json');
echo json_encode($response);
