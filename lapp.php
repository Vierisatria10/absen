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
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            padding: 10px;
            /* Menambahkan ruang padding di sekitar tabel */
            margin: 0;
        }

        .tbl-head {
            vertical-align: middle;
        }

        th,
        td {
            font-size: 12px;
            /* Mengurangi ukuran teks dalam sel */
            padding: 5px;
        }

        thead>tr:nth-child(1)>th:nth-child(1) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(2) {
            background-color: none;
            text-align: center;
            min-width: 150px;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(3) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(4) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(5) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }

        thead>tr:nth-child(1)>th:nth-child(6) {
            background-color: none;
            text-align: center;
            vertical-align: middle;
            align-items: center;
        }


        thead>tr:nth-child(2)>th {
            background-color: none;
        }

        @media (max-width: 600px) {
            table {
                width: 100%;
                /* Mengatur ulang lebar tabel untuk tampilan seluler */
            }
        }
    </style>
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
                            <h1 class="m-0">Data Laporan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Data Laporan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Form Filter -->
                    <form method="GET" action="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="filterKelas">Filter Kelas:</label>
                                <select class="form-control" id="filterKelas" name="filterKelas">
                                    <option value="">Semua Kelas</option>
                                    <?php
                                    // Ambil data kelas dari tabel kelas
                                    include 'koneksi.php';
                                    $queryKelas = "SELECT * FROM kelas";
                                    $resultKelas = $conn->query($queryKelas);

                                    if ($resultKelas->num_rows > 0) {
                                        while ($rowKelas = $resultKelas->fetch_assoc()) {
                                            echo '<option value="' . $rowKelas['Nama_Kelas'] . '">' . $rowKelas['Nama_Kelas'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="filterBulan">Filter Bulan:</label>
                                <select class="form-control" id="filterBulan" name="filterBulan">
                                    <!-- Daftar bulan -->
                                    <?php
                                    // Array daftar nama bulan
                                    $namaBulan = array(
                                        "01" => "Januari",
                                        "02" => "Februari",
                                        "03" => "Maret",
                                        "04" => "April",
                                        "05" => "Mei",
                                        "06" => "Juni",
                                        "07" => "Juli",
                                        "08" => "Agustus",
                                        "09" => "September",
                                        "10" => "Oktober",
                                        "11" => "November",
                                        "12" => "Desember"
                                    );

                                    // Loop untuk menambahkan opsi bulan
                                    foreach ($namaBulan as $kodeBulan => $nama) {
                                        echo '<option value="' . $kodeBulan . '">' . $nama . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submitFilter">Filter</button>
                    </form>


                    <!-- Tambahkan tombol submit untuk mengirim formulir -->


                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            $currentMonth = date('F');
                                            echo '<h3 class="card-title">Data Laporan Absensi Bulan ' . $currentMonth . '</h3>';
                                            ?>
                                        </div>
                                        <div class="col-md-6 text-right">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body overflow-auto">
                                    <?php
                                    include('koneksi.php');

                                    $filterKelas = isset($_GET['filterKelas']) ? $_GET['filterKelas'] : '';
                                    $kelasCondition = ($filterKelas != '') ? "AND k.ID_Kelas = '$filterKelas'" : '';

                                    $filterBulan = isset($_GET['filterBulan']) ? $_GET['filterBulan'] : '';
                                    $bulanCondition = ($filterBulan != '') ? "AND MONTH(a.Waktu_Absensi) = '$filterBulan'" : '';

                                    if (isset($_GET['submitFilter'])) {
                                        $querySiswa = "SELECT * FROM siswa s
                                                       JOIN kelas k ON s.ID_Kelas = k.ID_Kelas
                                                       WHERE 1 $kelasCondition
                                                       ORDER BY s.Nama_Siswa ASC";
                                    }

                                    $resultSiswa = $conn->query($querySiswa);
                                    $queryLibur = "SELECT tanggal FROM hari_libur";
                                    $resultLibur = $conn->query($queryLibur);
                                    $liburDates = [];

                                    if ($resultLibur->num_rows > 0) {
                                        while ($rowLibur = $resultLibur->fetch_assoc()) {
                                            $liburDates[] = $rowLibur['tanggal'];
                                        }
                                    }

                                    $str = '31/10/2023';
                                    $date = DateTime::createFromFormat('d/m/Y', $str);
                                    $currentDate = $date->format('Y-m-d');

                                    $currentMonth = date('F');
                                    $daysInMonth = date('t');

                                    echo '<table class="table table-bordered">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th rowspan="2">#</th>';
                                    echo '<th rowspan="2" class="nama-siswa">Nama Siswa</th>';
                                    echo '<th rowspan="2">NIS</th>';
                                    echo '<th rowspan="2">L/P</th>';
                                    echo '<th colspan="' . $daysInMonth . '">Tanggal</th>';
                                    echo '<th colspan="4">Jumlah</th>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    for ($day = 1; $day <= $daysInMonth; $day++) {
                                        $date = date("Y-m-d", strtotime("$currentDate +$day day"));
                                        $dayOfWeek = date("N", strtotime($date));
                                        $cellColor = ($dayOfWeek == 7) ? ' style="background-color: red;"' : '';

                                        if (in_array($date, $liburDates)) {
                                            $cellColor .= ' style="background-color: red;"';
                                        }

                                        echo '<th' . $cellColor . '>' . date("j", strtotime($date)) . '</th>';
                                    }
                                    echo '<th rowspan="5">Hadir</th>';
                                    echo '<th rowspan="6">Sakit</th>';
                                    echo '<th rowspan="7">Izin</th>';
                                    echo '<th rowspan="8">Alpha</th>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    $nomorUrut = 1;
                                    while ($rowSiswa = $resultSiswa->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $nomorUrut . '</td>';
                                        echo '<td>' . $rowSiswa['Nama_Siswa'] . '</td>';
                                        echo '<td>' . $rowSiswa['NIS'] . '</td>';
                                        echo '<td>' . ($rowSiswa['Jenis_Kelamin'] == 'Laki-laki' ? 'L' : 'P') . '</td>';

                                        $totalSakit = 0;
                                        $totalIzin = 0;
                                        $totalAlpha = 0;
                                        $totalHadir = 0;

                                        for ($day = 1; $day <= $daysInMonth; $day++) {
                                            $date = date("Y-m-d", strtotime("$currentDate +$day day"));
                                            $dayOfWeek = date("N", strtotime($date));
                                            $cellColor = ($dayOfWeek == 7 || in_array($date, $liburDates)) ? ' style="background-color: red;"' : '';

                                            if ($dayOfWeek == 7 || in_array($date, $liburDates)) {
                                                echo '<td' . $cellColor . '></td>';
                                            } else {
                                                $queryAbsensi = "SELECT Keterangan FROM absensi WHERE DATE(Waktu_Absensi) = '$date' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "'";
                                                $resultAbsensi = $conn->query($queryAbsensi);

                                                if ($resultAbsensi) {
                                                    if ($resultAbsensi->num_rows > 0) {
                                                        $rowAbsensi = $resultAbsensi->fetch_assoc();
                                                        $badgeColor = '';
                                                        $label = '';

                                                        if ($rowAbsensi['Keterangan'] == 'hadir') {
                                                            $badgeColor = 'badge-success';
                                                            $label = 'H';
                                                        } elseif ($rowAbsensi['Keterangan'] == 'izin') {
                                                            $badgeColor = 'badge-warning';
                                                            $label = 'I';
                                                        } elseif ($rowAbsensi['Keterangan'] == 'sakit') {
                                                            $badgeColor = 'badge-secondary';
                                                            $label = 'S';
                                                        } elseif ($rowAbsensi['Keterangan'] == 'alpha') {
                                                            $badgeColor = 'badge-danger';
                                                            $label = 'A';
                                                        }

                                                        echo '<td' . $cellColor . '><span class="badge ' . $badgeColor . '">' . $label . '</span></td>';
                                                    } else {
                                                        echo '<td' . $cellColor . '>?</td>';
                                                    }
                                                } else {
                                                    echo '<td' . $cellColor . '>Error: ' . $conn->error . '</td>';
                                                }
                                            }
                                        }

                                        $bulansekarang = date('m');
                                        $queryAbsensiSakit = "SELECT COUNT(*) AS totalSakit FROM absensi WHERE MONTH(Waktu_Absensi) = '$bulansekarang' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'sakit'";
                                        $queryAbsensiIzin = "SELECT COUNT(*) AS totalizin FROM absensi WHERE MONTH(Waktu_Absensi) = '$bulansekarang' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'izin'";
                                        $queryAbsensiHadir = "SELECT COUNT(*) AS totalhadir FROM absensi WHERE MONTH(Waktu_Absensi) = '$bulansekarang' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'hadir'";
                                        $queryAbsensiAlpha = "SELECT COUNT(*) AS totalalpha FROM absensi WHERE MONTH(Waktu_Absensi) = '$bulansekarang' AND ID_Siswa = '" . $rowSiswa['ID_Siswa'] . "' AND Keterangan = 'alpha'";
                                        $resultAbsensiSakit = $conn->query($queryAbsensiSakit);
                                        $resultAbsensiizin = $conn->query($queryAbsensiIzin);
                                        $resultAbsensihadir = $conn->query($queryAbsensiHadir);
                                        $resultAbsensialpha = $conn->query($queryAbsensiAlpha);
                                        $rowAbsensiSakit = $resultAbsensiSakit->fetch_assoc();
                                        $rowAbsensiIzin = $resultAbsensiizin->fetch_assoc();
                                        $rowAbsensiHadir = $resultAbsensihadir->fetch_assoc();
                                        $rowAbsensiAlpha = $resultAbsensialpha->fetch_assoc();
                                        $totalSakit += (int)$rowAbsensiSakit['totalSakit'];
                                        $totalIzin += (int)$rowAbsensiIzin['totalizin'];
                                        $totalHadir += (int)$rowAbsensiHadir['totalhadir'];
                                        $totalAlpha += (int)$rowAbsensiAlpha['totalalpha'];

                                        echo '<td style="text-align:center;">' . $totalHadir . '</td>';
                                        echo '<td style="text-align:center;">' . $totalSakit . '</td>';
                                        echo '<td style="text-align:center;">' . $totalIzin . '</td>';
                                        echo '<td style="text-align:center;">' . $totalAlpha . '</td>';

                                        echo '</tr>';
                                        $nomorUrut++;
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                    ?>
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