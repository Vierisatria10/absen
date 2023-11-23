<?php
// Include file koneksi database
include('koneksi.php');

function tambahGuru($nama_guru, $mata_pelajaran) {
    global $conn;

    $nama_guru = mysqli_real_escape_string($conn, $nama_guru);
    $mata_pelajaran = mysqli_real_escape_string($conn, $mata_pelajaran);

    // Query tambah guru
    $query = "INSERT INTO guru (Nama_Guru, Mata_Pelajaran) VALUES ('$nama_guru', '$mata_pelajaran')";
    $result = mysqli_query($conn, $query);

    return $result;
}

function editGuru($id_guru, $nama_guru, $mata_pelajaran) {
    global $conn;

    $id_guru = mysqli_real_escape_string($conn, $id_guru);
    $nama_guru = mysqli_real_escape_string($conn, $nama_guru);
    $mata_pelajaran = mysqli_real_escape_string($conn, $mata_pelajaran);

    // Query edit guru
    $query = "UPDATE guru SET Nama_Guru='$nama_guru', Mata_Pelajaran='$mata_pelajaran' WHERE ID_Guru='$id_guru'";
    $result = mysqli_query($conn, $query);

    return $result;
}

function hapusGuru($id_guru) {
    global $conn;

    $id_guru = mysqli_real_escape_string($conn, $id_guru);

    // Query hapus guru
    $query = "DELETE FROM guru WHERE ID_Guru='$id_guru'";
    $result = mysqli_query($conn, $query);

    return $result;
}

function getDaftarGuru() {
    global $conn;

    // Query untuk mengambil data guru dari tabel guru
    $query = "SELECT * FROM guru";
    $result = mysqli_query($conn, $query);

    $daftarGuru = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $daftarGuru[] = $row;
    }

    return $daftarGuru;
}

function getGuruById($id_guru) {
    global $conn;

    $id_guru = mysqli_real_escape_string($conn, $id_guru);

    // Query untuk mengambil data guru berdasarkan ID
    $query = "SELECT * FROM guru WHERE ID_Guru='$id_guru'";
    $result = mysqli_query($conn, $query);

    $guru = mysqli_fetch_assoc($result);

    return $guru;
}
?>
