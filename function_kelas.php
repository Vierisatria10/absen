<?php 

include 'koneksi.php';

if($_GET['act']== 'tambahkelas'){
    $kelas = $_POST['kelas'];
    $wali_kelas = $_POST['wali_kelas'];

    //query
    $querytambah =  mysqli_query($conn, "INSERT INTO kelas VALUES('' , '$kelas' , '$wali_kelas')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location:data_kelas.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($conn);
    }
}

elseif ($_GET['act'] == 'hapuskelas'){
    $id_kelas = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($conn, "DELETE FROM kelas WHERE ID_Kelas = '$id_kelas'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:data_kelas.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($conn);
    }

    mysqli_close($conn);
}

 ?>