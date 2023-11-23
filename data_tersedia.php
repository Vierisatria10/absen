<?php
include 'koneksi.php';

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil ID siswa dari tabel tmprfid
$sql = "SELECT id FROM tmprfid ORDER BY id DESC LIMIT 1"; // Mengambil ID terbaru
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idSiswa = $row['id'];

    // Query untuk mengambil data siswa berdasarkan ID_Siswa
    $sqlSiswa = "SELECT * FROM siswa WHERE ID_Siswa = $idSiswa";
    $resultSiswa = $conn->query($sqlSiswa);

    if ($resultSiswa->num_rows > 0) {
        $rowSiswa = $resultSiswa->fetch_assoc();
        $namaSiswa = $rowSiswa['Nama_Siswa'];
        $nis = $rowSiswa['NIS'];
        $alamat = $rowSiswa['Alamat'];
        $kelas = $rowSiswa['ID_Kelas'];
        $foto = $rowSiswa['ID_Siswa'];

        // Tampilkan data siswa
    
        echo '<div class="container mt-4 content text-center">';
        echo '<img src="image/' . $foto . '.jpeg"  alt="Profil" width="150" class="img-fluid profil-foto rounded-circle">';
        echo '<h6 id="tanggal-waktu" class="mt-4"></h6>';
        echo "<h1>$namaSiswa</h1>";
        echo "<h4>NIS: $nis</h4>";
        echo "<h4>Alamat: $alamat</h4>";
        echo "<h4>Kelas: $kelas</h4>";
        echo '</div>';

    } else {
        echo "Data siswa tidak ditemukan.";
    }
} else {
    echo "Tidak ada data pada tmprfid.";
}

$query = "DELETE FROM tmprfid";
mysqli_query($conn,$query);

// Menutup koneksi ke database

mysqli_close($conn);
?>




