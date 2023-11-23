<?php
include('koneksi.php');


if ($_GET['act'] == 'tambahsiswa') {
    $id_siswa = mysqli_real_escape_string($conn, $_POST['id_siswa']);
    $nama_siswa = mysqli_real_escape_string($conn, $_POST['nama']);
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);

    // Validasi input (contoh: pastikan semua field diisi)
    if (empty($id_siswa) || empty($nama_siswa) || empty($nis) || empty($date) || empty($alamat) || empty($kelas)) {
        echo "Semua field harus diisi!";
    } else {
        // Proses unggah file foto siswa
        $namaFile = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];

        // Pisahkan nama file dan ekstensi
        $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
        $namaFileBaru = uniqid() . '.' . $ext;

        $direktoriTujuan = 'img/' . $namaFileBaru;

        // Proses penanganan file yang diunggah
        if ($error === UPLOAD_ERR_OK) {
            if (move_uploaded_file($tmpName, $direktoriTujuan)) {
                $namaFileDB = mysqli_real_escape_string($conn, $namaFileBaru);

                // Query INSERT ke tabel siswa
                $queryInsert = "INSERT INTO siswa (ID_Siswa, Nama_Siswa, NIS, Tanggal_Lahir, Alamat, ID_Kelas, foto_siswa) VALUES ('$id_siswa', '$nama_siswa', '$nis', '$date', '$alamat', '$kelas', '$namaFileDB')";

                if (mysqli_query($conn, $queryInsert)) {
                    // Jika berhasil disimpan ke basis data
                    header("location:data_siswa.php");
                } else {
                    // Jika gagal menyimpan ke basis data
                    echo "Gagal menyimpan data siswa: " . mysqli_error($conn);
                }
            } else {
                echo "Gagal mengunggah file gambar.";
            }
        } else {
            echo "Error dalam proses unggah file gambar.";
        }
    }
}

// Hapus siswa
// Hapus siswa
elseif ($_GET['act'] == 'hapussiswa') {
    $id_siswa = mysqli_real_escape_string($conn, $_GET['id']);

    // Ambil nama foto siswa sebelum menghapus entri siswa
    $queryGetFoto = mysqli_query($conn, "SELECT foto_siswa FROM siswa WHERE ID_Siswa = '$id_siswa'");
    $result = mysqli_fetch_assoc($queryGetFoto);
    $fotoSiswa = $result['foto_siswa'];

    // Hapus foto dari direktori jika ada
    if ($fotoSiswa) {
        $fileLocation = 'img/' . $fotoSiswa;
        if (file_exists($fileLocation)) {
            unlink($fileLocation); // Menghapus file dari direktori
        }
    }

    // Query hapus
    $querydelete = mysqli_query($conn, "DELETE FROM siswa WHERE ID_siswa = '$id_siswa'");

    if ($querydelete) {
        header("location:data_siswa.php");
    } else {
        echo "ERROR, data gagal dihapus: " . mysqli_error($conn);
    }
}


// edit siswa
elseif ($_GET['act'] == 'editsiswa') {
    $id = mysqli_real_escape_string($conn, $_POST['id_siswa']);
    $nama_siswa = mysqli_real_escape_string($conn, $_POST['nama']);
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $tgl_lahir = mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);

    if (empty($id) || empty($nama_siswa) || empty($nis) || empty($tgl_lahir) || empty($alamat) || empty($kelas)) {
        echo "Semua field harus diisi!";
    } else {
        $queryGetOldFoto = mysqli_query($conn, "SELECT foto_siswa FROM siswa WHERE ID_Siswa='$id'");
        $oldPhoto = mysqli_fetch_assoc($queryGetOldFoto)['foto_siswa'];

        if (!empty($_FILES['foto']['name'])) {
            // Hapus foto lama
            if ($oldPhoto) {
                $pathOldPhoto = 'img/' . $oldPhoto;
                if (file_exists($pathOldPhoto)) {
                    unlink($pathOldPhoto);
                }
            }

            // Proses unggah file foto siswa
            $namaFile = $_FILES['foto']['name'];
            $ukuranFile = $_FILES['foto']['size'];
            $error = $_FILES['foto']['error'];
            $tmpName = $_FILES['foto']['tmp_name'];

            // Pisahkan nama file dan ekstensi
            $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
            $namaFileBaru = uniqid() . '.' . $ext;
            $direktoriTujuan = 'img/' . $namaFileBaru;

            // Proses penanganan file yang diunggah
            if ($error === UPLOAD_ERR_OK) {
                if (move_uploaded_file($tmpName, $direktoriTujuan)) {
                    $namaFileDB = mysqli_real_escape_string($conn, $namaFileBaru);

                    // Query update termasuk foto baru
                    $queryupdate = mysqli_query($conn, "UPDATE siswa SET Nama_Siswa='$nama_siswa', NIS='$nis', Tanggal_Lahir='$tgl_lahir', Alamat='$alamat', ID_Kelas='$kelas', foto_siswa='$namaFileDB' WHERE ID_Siswa='$id'");

                    if ($queryupdate) {
                        header("location:data_siswa.php");
                    } else {
                        echo "ERROR, data gagal diupdate: " . mysqli_error($conn);
                    }
                } else {
                    echo "Gagal mengunggah file gambar.";
                }
            } else {
                echo "Error dalam proses unggah file gambar.";
            }
        } else {
            // Query update tanpa mengubah foto
            $queryupdate = mysqli_query($conn, "UPDATE siswa SET Nama_Siswa='$nama_siswa', NIS='$nis', Tanggal_Lahir='$tgl_lahir', Alamat='$alamat', ID_Kelas='$kelas' WHERE ID_Siswa='$id'");

            if ($queryupdate) {
                header("location:data_siswa.php");
            } else {
                echo "ERROR, data gagal diupdate: " . mysqli_error($conn);
            }
        }
    }
}
