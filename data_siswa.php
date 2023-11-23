<?php
// Include file koneksi database
include('koneksi.php');

// Fungsi untuk mengambil data siswa dari database

// ... (kode lainnya)

?>

<!-- modal insert -->
<div class="example-modal">
  <div id="tambahsiswa" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Tambah Siswa Baru</h3>
        </div>
        <div class="modal-body">
          <form action="function_siswa.php?act=tambahsiswa" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 control-label text-right">Id Siswa <span class="text-red">*</span></label>
                <div class="col-sm-8"><input type="text" class="form-control" name="id_siswa" placeholder="Id Siswa" value=""></div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 control-label text-right">Nama<span class="text-red">*</span></label>
                <div class="col-sm-8"><input type="text" class="form-control" name="nama" placeholder="Nama Siswa" value=""></div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 control-label text-right">NIS<span class="text-red">*</span></label>
                <div class="col-sm-8"><input type="text" class="form-control" name="nis" placeholder="NIS" value=""></div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 control-label text-right">Tgl. Lahir<span class="text-red">*</span></label>
                <div class="col-sm-8"><input type="date" class="form-control" name="date" placeholder="tgl. lahir" value=""></div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 control-label text-right">Alamat<span class="text-red">*</span></label>
                <div class="col-sm-8"><textarea class="form-control" name="alamat" placeholder="Alamat" value=""></textarea></div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 control-label text-right">Kelas <span class="text-red">*</span></label>
                <div class="col-sm-8"><select name="kelas" class="form-control select2" style="width: 100%;">
                    <option value="User" selected="selected">-- Pilih Satu --</option>
                    <?php
                    // Query untuk mengambil data kelas dari tabel kelas
                    $query_kelas = "SELECT ID_Kelas, Nama_Kelas FROM kelas";
                    $result_kelas = mysqli_query($conn, $query_kelas);

                    // Mengisi opsi dalam elemen <select> dengan data kelas
                    while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                      echo '<option value="' . $row_kelas['ID_Kelas'] . '">' . $row_kelas['Nama_Kelas'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 control-label text-right">Foto<span class="text-red">*</span></label>
                <div class="col-sm-8"><input type="file" class="form-control" name="foto"></div>
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
  <title>Data Laporan</title>

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
              <h1 class="m-0">Data Siswa</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Data Siswa</li>
              </ol>
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
                      <h3 class="card-title">Data Siswa</h3>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" class="breadcrumb-item" data-toggle="modal" data-target="#tambahsiswa">Tambah Siswa</a>
                    </div>
                  </div>
                </div>

                <div class="card-body overflow-auto">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px;">No.</th>
                        <th>Foto</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT s.*, k.Nama_Kelas FROM siswa s LEFT JOIN kelas k ON s.ID_Kelas = k.ID_Kelas"; // Query SQL Anda

                      $result = mysqli_query($conn, $query);
                      $no = 1;

                      if ($result) {
                        while ($student = mysqli_fetch_assoc($result)) {
                          echo '<tr>';
                          echo '<td>' . $no . '</td>';
                          echo '<td>' . $student['foto_siswa'] . '</td>';

                          echo '<td>' . $student['Nama_Siswa'] . '</td>';
                          echo '<td>' . $student['NIS'] . '</td>';
                          echo '<td>' . $student['Nama_Kelas'] . '</td>';
                          echo '<td>' . $student['Alamat'] . '</td>';
                          echo '<td>
                  <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#ubahsiswa' . $no . '"><i class="fa fa-pen"></i> Ubah</a> | 
                  <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#hapussiswa' . $no . '"><i class="fa fa-trash"></i> Hapus</a>
              </td>';
                          echo '</tr>';

                          // Modal hapus sesuai nomor
                          echo '<div class="example-modal">';
                          echo '<div id="hapussiswa' . $no . '" class="modal fade" role="dialog" style="display:none;">';
                          echo '<div class="modal-dialog">';
                          echo '<div class="modal-content">';
                          echo '<div class="modal-header">';
                          echo '<h3 class="modal-title">Konfirmasi Hapus Data Siswa</h3>';
                          echo '</div>';
                          echo '<div class="modal-body">';
                          echo '<h4 align="center">Apakah anda yakin ingin menghapus Siswa ' . $student['ID_Siswa'] . ' - ' . $student['Nama_Siswa'] . '<strong><span class="grt"></span></strong> ?</h4>';
                          echo '</div>';
                          echo '<div class="modal-footer">';
                          echo '<button id="nodelete" type="button" class="btn btn-light pull-left" data-dismiss="modal">Batal</button>';
                          echo '<a href="function_siswa.php?act=hapussiswa&id=' . $student['ID_Siswa'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';

                          // Modal edit sesuai nomor
                          echo '<div class="example-modal">';
                          echo '<div id="ubahsiswa' . $no . '" class="modal fade" role="dialog" style="display:none;">';
                          echo '<div class="modal-dialog">';
                          echo '<div class="modal-content">';
                          echo '<div class="modal-header">';
                          echo '<h3 class="modal-title">Edit Data Siswa</h3>';
                          echo '</div>';
                          echo '<div class="modal-body">';
                          // Form untuk mengedit data siswa, termasuk foto siswa
                          echo '<form action="function_siswa.php?act=editsiswa&id=' . $student['ID_Siswa'] . '" method="post" role="form" enctype="multipart/form-data">';
                          echo '<div class="form-group">';
                          echo '<label class="control-label">ID Siswa<span class="text-red">*</span></label>';
                          echo '<input type="text" class="form-control" name="id_siswa" placeholder="ID Siswa" value="' . $student['ID_Siswa'] . '">';
                          echo '</div>';
                          echo '<div class="form-group">';
                          echo '<label class="control-label">Nama<span class="text-red">*</span></label>';
                          echo '<input type="text" class="form-control" name="nama" placeholder="Nama Siswa" value="' . $student['Nama_Siswa'] . '">';
                          echo '</div>';
                          echo '<div class="form-group">';
                          echo '<label class="control-label">NIS<span class="text-red">*</span></label>';
                          echo '<input type="text" class="form-control" name="nis" placeholder="NIS" value="' . $student['NIS'] . '">';
                          echo '</div>';
                          echo '<div class="form-group">';
                          echo '<label class="control-label">Tanggal Lahir<span class="text-red">*</span></label>';
                          echo '<input type="date" class="form-control" name="tgl_lahir" value="' . $student['Tanggal_Lahir'] . '">';
                          echo '</div>';
                          echo '<div class="form-group">';
                          echo '<label class="control-label">Alamat<span class="text-red">*</span></label>';
                          echo '<textarea class="form-control" name="alamat">' . $student['Alamat'] . '</textarea>';
                          echo '</div>';
                          echo '<div class="form-group">';
                          echo '<label class="control-label">Kelas<span class="text-red">*</span></label>';
                          echo '<select name="kelas" class="form-control">';
                          echo '<option value="">-- Pilih Kelas --</option>';

                          // Mendapatkan daftar kelas dari database
                          $query_kelas = "SELECT ID_Kelas, Nama_Kelas FROM kelas";
                          $result_kelas = mysqli_query($conn, $query_kelas);

                          while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                            // Jika kelas pada data siswa cocok dengan kelas pada daftar, tandai sebagai terpilih
                            $selected = ($student['ID_Kelas'] == $row_kelas['ID_Kelas']) ? 'selected' : '';
                            echo '<option value="' . $row_kelas['ID_Kelas'] . '" ' . $selected . '>' . $row_kelas['Nama_Kelas'] . '</option>';
                          }

                          echo '</select>';
                          echo '</div>';
                          echo '<div class="form-group">';
                          echo '<label class="control-label">Foto<span class="text-red">*</span></label>';
                          echo '<input type="file" class="form-control" name="foto">';
                          echo '</div>';
                          echo '<input type="hidden" name="foto_lama" value="' . $student['foto_siswa'] . '">';

                          echo '<div class="modal-footer">';
                          echo '<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>';
                          echo '<input type="submit" name="submit" class="btn btn-primary" value="Simpan Perubahan">';
                          echo '</div>';
                          echo '</form>';

                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';

                          $no++; // Increment nomor urut
                        }
                      } else {
                        echo "Gagal menjalankan query: " . mysqli_error($conn);
                      }
                      ?>



                      <!-- Modal delete -->
                      <div class="example-modal">
                        <div id="hapussiswa" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title">Konfirmasi Hapus Data Siswa</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center">Apakah anda yakin ingin menghapus Siswa ini<strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-light pull-left" data-dismiss="modal">Batal</button>
                                <a href="function_siswa.php?act=hapussiswa&id=<?php echo $student['ID_Siswa']; ?>" class="btn btn-primary"><i class="fa fa-trash"></i> Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


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
    <?php include 'footer.php' ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->

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