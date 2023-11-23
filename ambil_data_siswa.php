<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_siswa = $_GET['id']; // Ambil ID dari parameter GET

    // Query untuk mendapatkan data siswa dan kelas siswa berdasarkan ID
    $query = "SELECT siswa.*, kelas.nama_kelas FROM siswa
              LEFT JOIN kelas ON siswa.ID_Kelas = kelas.ID_Kelas
              WHERE siswa.ID_Siswa = $id_siswa";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $siswa = mysqli_fetch_assoc($result);
        echo json_encode($siswa);


        // Mengembalikan data siswa beserta kelas sebagai respons JSON
    } else {
        echo json_encode(['error' => 'Tidak ada data siswa dengan ID yang diberikan']);
    }
} else {
    echo json_encode(['error' => 'Parameter ID tidak ditemukan']);
}
