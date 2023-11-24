<?php
// Include file koneksi database
include('koneksi.php');
include('fungsi_guru.php'); // Sisipkan file fungsi_guru.php yang telah kami buat

// Cek jika tindakan (act) yang diminta adalah tambah guru
if (isset($_GET['act']) && $_GET['act'] == 'tambahguru') {
    if (isset($_POST['submit'])) {
        $nama_guru = $_POST['nama_guru'];
        $mata_pelajaran = $_POST['mata_pelajaran'];

        // Panggil fungsi untuk menambahkan guru
        $result = tambahGuru($nama_guru, $mata_pelajaran);

        if ($result) {
            // Redirect ke halaman data guru jika tambah guru berhasil
            header("location:data_guru.php");
        } else {
            echo "ERROR, tidak berhasil menambahkan guru: " . mysqli_error($conn);
        }
    }
}

// Cek jika tindakan (act) yang diminta adalah edit guru
if (isset($_GET['act']) && $_GET['act'] == 'editguru') {
    if (isset($_POST['submit'])) {
        $id_guru = $_POST['id_guru'];
        $nama_guru = $_POST['nama_guru'];
        $mata_pelajaran = $_POST['mata_pelajaran'];

        // Panggil fungsi untuk mengedit guru
        $result = editGuru($id_guru, $nama_guru, $mata_pelajaran);

        if ($result) {
            // Redirect ke halaman data guru jika edit guru berhasil
            header("location:data_guru.php");
        } else {
            echo "ERROR, tidak berhasil mengedit guru: " . mysqli_error($conn);
        }
    }
}

// Cek jika tindakan (act) yang diminta adalah hapus guru
if (isset($_GET['act']) && $_GET['act'] == 'hapusguru') {
    if (isset($_GET['id'])) {
        $id_guru = $_GET['id'];

        // Panggil fungsi untuk menghapus guru
        $result = hapusGuru($id_guru);

        if ($result) {
            // Redirect ke halaman data guru jika hapus guru berhasil
            header("location:data_guru.php");
        } else {
            echo "ERROR, tidak berhasil menghapus guru: " . mysqli_error($conn);
        }
    }
}

  session_start();

  if(!$_SESSION['id_user']){
    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Guru</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include 'navbar.php' ?>

    <?php include 'sidebar.php' ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Guru</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Guru</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->
        <!-- Modal Tambah Guru -->
        <div class="modal fade" id="tambahGuruModal" tabindex="-1" role="dialog" aria-labelledby="tambahGuruModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahGuruModalLabel">Tambah Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="data_guru.php?act=tambahguru" method="post">
                            <div class="form-group">
                                <label for="nama_guru">Nama Guru:</label>
                                <input type="text" class="form-control" id="nama_guru" name="nama_guru" required>
                            </div>
                            <div class="form-group">
                                <label for="mata_pelajaran">Mata Pelajaran:</label>
                                <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Data Guru</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahGuruModal"><i class="fas fa-plus"></i> Tambah Guru</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered" id="tbl_guru">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Nama Guru</th>
                                        <th>Mata Pelajaran</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $daftarGuru = getDaftarGuru(); // Panggil fungsi untuk mendapatkan data guru
                                    $no = 1;

                                    foreach ($daftarGuru as $guru) {
                                        echo '<tr>';
                                        echo '<td>' . $no . '</td>';
                                        echo '<td>' . $guru['Nama_Guru'] . '</td>';
                                        echo '<td>' . $guru['Mata_Pelajaran'] . '</td>';
                                        echo '<td>
                                                  <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#editGuruModal'.$guru['ID_Guru'].'"><i class="fa fa-pen"></i> Ubah</a> |
                                                  <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#hapusGuruModal'.$guru['ID_Guru'].'"><i class="fa fa-trash"></i> Hapus</a>
                                              </td>';
                                        echo '</tr>';

                                        // Modal Edit Guru
                                        echo '<div class="modal fade" id="editGuruModal'.$guru['ID_Guru'].'" tabindex="-1" role="dialog" aria-labelledby="editGuruModalLabel'.$guru['ID_Guru'].'" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editGuruModalLabel'.$guru['ID_Guru'].'">Edit Guru</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="data_guru.php?act=editguru" method="post">
                                                                <div class="form-group">
                                                                    <label for="edit_nama_guru">Nama Guru:</label>
                                                                    <input type="text" class="form-control" id="edit_nama_guru" name="nama_guru" value="'.$guru['Nama_Guru'].'" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_mata_pelajaran_guru">mata_pelajaran:</label>
                                                                    <input type="text" class="form-control" id="edit_mata_pelajaran_guru" name="mata_pelajaran" value="'.$guru['Mata_Pelajaran'].'" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <input type="hidden" name="id_guru" value="'.$guru['ID_Guru'].'">
                                                                    <input type="submit" name="submit" class="btn btn-primary" value="Simpan Perubahan">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';

                                        // Modal Hapus Guru
                                        echo '<div class="modal fade" id="hapusGuruModal'.$guru['ID_Guru'].'" tabindex="-1" role="dialog" aria-labelledby="hapusGuruModalLabel'.$guru['ID_Guru'].'" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusGuruModalLabel'.$guru['ID_Guru'].'">Hapus Guru</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus guru ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <a href="data_guru.php?act=hapusguru&id='.$guru['ID_Guru'].'" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';

                                        $no++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include 'footer.php' ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script>
	$('#tbl_guru').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  </script>
</body>
</html>
