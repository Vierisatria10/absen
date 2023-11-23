<?php
// Include file koneksi database
include('koneksi.php');

function tambahKelas($nama_kelas, $id_wali_kelas) {
    global $conn;

    $nama_kelas = mysqli_real_escape_string($conn, $nama_kelas);

    // Query tambah kelas
    $query = "INSERT INTO kelas (Nama_Kelas, ID_Wali_Kelas) VALUES ('$nama_kelas', $id_wali_kelas)";
    $result = mysqli_query($conn, $query);

    return $result;
}

function editKelas($id_kelas, $nama_kelas, $id_wali_kelas) {
    global $conn;

    $id_kelas = mysqli_real_escape_string($conn, $id_kelas);
    $nama_kelas = mysqli_real_escape_string($conn, $nama_kelas);

    // Query edit kelas
    $query = "UPDATE kelas SET Nama_Kelas='$nama_kelas', ID_Wali_Kelas=$id_wali_kelas WHERE ID_Kelas=$id_kelas";
    $result = mysqli_query($conn, $query);

    return $result;
}

function hapusKelas($id_kelas) {
    global $conn;

    $id_kelas = mysqli_real_escape_string($conn, $id_kelas);

    // Query hapus kelas
    $query = "DELETE FROM kelas WHERE ID_Kelas=$id_kelas";
    $result = mysqli_query($conn, $query);

    return $result;
}

function getDaftarKelas() {
    global $conn;

    // Query untuk mengambil data kelas dari tabel kelas
    $query = "SELECT kelas.*, guru.Nama_Guru AS Nama_Wali_Kelas FROM kelas
              LEFT JOIN guru ON kelas.ID_Wali_Kelas = guru.ID_Guru";
    $result = mysqli_query($conn, $query);

    $daftarKelas = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $daftarKelas[] = $row;
    }

    return $daftarKelas;
}

function getKelasById($id_kelas) {
    global $conn;

    $id_kelas = mysqli_real_escape_string($conn, $id_kelas);

    // Query untuk mengambil data kelas berdasarkan ID
    $query = "SELECT kelas.*, guru.Nama_Guru AS Nama_Wali_Kelas FROM kelas
              LEFT JOIN guru ON kelas.ID_Wali_Kelas = guru.ID_Guru
              WHERE ID_Kelas=$id_kelas";
    $result = mysqli_query($conn, $query);

    $kelas = mysqli_fetch_assoc($result);

    return $kelas;
}
?>
