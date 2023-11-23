<?php
// Include file koneksi database
include('koneksi.php');
include('fungsi_kelas.php'); // Menggunakan fungsi-fungsi terkait data kelas

// ... (kode lainnya)

?>

<!-- modal insert -->
<div class="example-modal">
  <div id="tambahkelas" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Tambah Kelas Baru</h3>
        </div>
        <div class="modal-body">
          <form action="function_kelas.php?act=tambahkelas" method="post" role="form">
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 control-label text-right">Nama Kelas <span class="text-red">*</span></label>
                <div class="col-sm-8"><input type="text" class="form-control" name="nama_kelas" placeholder="Nama Kelas" value=""></div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 control-label text-right">ID Wali Kelas<span class="text-red">*</span></label>
                <div class="col-sm-8"><input type="text" class="form-control" name="id_wali_kelas" placeholder="ID Wali Kelas" value=""></div>
              </div>
            </div>
            <div class="modal-footer">
              <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
              <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal insert close -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | Absensi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
              <h1 class="m-0">Data Kelas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Data Kelas</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                      <h3 class="card-title">Data Kelas</h3>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" class="breadcrumb-item" data-toggle="modal" data-target="#tambahkelas">Tambah Kelas</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">No.</th>
                        <th>Nama Kelas</th>
                        <th>Wali Kelas</th>
                        <th style="width:150px;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $daftarKelas = getDaftarKelas(); // Menggunakan fungsi untuk mengambil daftar kelas
                      $no = 1;

                      foreach ($daftarKelas as $kelas) {
                        echo '<tr>';
                        echo '<td>' . $no . '</td>';
                        echo '<td>' . $kelas['Nama_Kelas'] . '</td>';
                        echo '<td>' . $kelas['Nama_Guru'] . '</td>';
                        echo '<td>
              <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#ubahkelas' . $no . '"><i class="fa fa-pen"></i> Ubah</a> | 
              <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#hapuskelas' . $no . '"><i class="fa fa-trash"></i> Hapus</a>
          </td>';
                        echo '</tr>';

                        // Modal hapus sesuai nomor
                        echo '<div class="example-modal">';
                        echo '<div id="hapuskelas' . $no . '" class="modal fade" role="dialog" style="display:none;">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h3 class="modal-title">Konfirmasi Hapus Data Kelas</h3>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<h4 align="center">Apakah anda yakin ingin menghapus Kelas ' . $kelas['ID_Kelas'] . ' - ' . $kelas['Nama_Kelas'] . '<strong><span class="grt"></span></strong> ?</h4>';
                        echo '</div>';
                        echo '<div class="modal-footer">';
                        echo '<button id="nodelete" type="button" class="btn btn-light pull-left" data-dismiss="modal">Batal</button>';
                        echo '<a href="function_kelas.php?act=hapuskelas&id=' . $kelas['ID_Kelas'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        // Modal edit sesuai nomor
                        echo '<div class="example-modal">';
                        echo '<div id="ubahkelas' . $no . '" class="modal fade" role="dialog" style="display:none;">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h3 class="modal-title">Edit Data Kelas</h3>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form action="function_kelas.php?act=editkelas&id=' . $kelas['ID_Kelas'] . '" method="post" role="form">';
                        echo '<div class="form-group">';
                        echo '<label class="control-label">ID Kelas<span class="text-red">*</span></label>';
                        echo '<input type="text" class="form-control" name="id_kelas" placeholder="ID Kelas" value="' . $kelas['ID_Kelas'] . '" readonly>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label class="control-label">Nama Kelas<span class="text-red">*</span></label>';
                        echo '<input type="text" class="form-control" name="nama_kelas" placeholder="Nama Kelas" value="' . $kelas['Nama_Kelas'] . '">';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label class="control-label">ID Wali Kelas<span class="text-red">*</span></label>';
                        echo '<input type="text" class="form-control" name="id_wali_kelas" placeholder="ID Wali Kelas" value="' . $kelas['ID_Wali_Kelas'] . '">';
                        echo '</div>';
                        echo '<div class="modal-footer">';
                        echo '<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>';
                        echo '<input type="submit" name="submit" class="btn btn-primary" value="Simpan Perubahan">';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        $no++; // Increment nomor urut
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
</body>
</html>