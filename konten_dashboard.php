	<!-- Main content -->
          <div class="row">
            <div class="col-12">
              <!-- Tribute Card -->
              <div class="card collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">Aplikasi Absensi RFID</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body" style="display: none;">
                  <!-- Deskripsi Aplikasi -->
                  <p>Aplikasi Absensi RFID ini adalah hasil karya dari Fajar Shodiq, seorang mahasiswa yang sedang menyelesaikan studi di Institut Bhakti Nusantara. Aplikasi ini dikembangkan khusus untuk memenuhi kebutuhan absensi di SMK Yasfika Kalirejo, sebagai bagian dari proyek skripsi mahasiswa tersebut.</p>
                  <p><strong>Deskripsi Singkat:</strong></p>
                  <p>Aplikasi Absensi RFID ini merupakan solusi modern untuk manajemen absensi di SMK Yasfika Kalirejo. Dengan menggunakan teknologi RFID (Radio-Frequency Identification), aplikasi ini memungkinkan proses absensi menjadi lebih efisien dan akurat.</p>
                  <!-- Fitur Utama -->
                  <p><strong>Fitur Utama:</strong></p>
                  <ol>
                    <li><strong>Absensi Cepat:</strong> Siswa dapat melakukan absensi hanya dengan menggantungkan kartu RFID mereka ke perangkat yang sesuai, menghemat waktu dan mencegah penipuan absensi.</li>
                    <li><strong>Manajemen Kelas:</strong> Aplikasi ini memungkinkan pengelolaan data siswa dan kelas dengan mudah, termasuk penambahan dan penghapusan siswa.</li>
                    <li><strong>Rekam Absensi:</strong> Data absensi siswa tersimpan dengan rapi, memberikan visibilitas yang baik untuk pemantauan kehadiran.</li>
                    <li><strong>Laporan dan Analisis:</strong> Aplikasi menyediakan laporan kehadiran yang dapat diakses dengan mudah untuk evaluasi dan analisis.</li>
                  </ol>
                  <p>Aplikasi ini merupakan wujud komitmen Fajar Shodiq untuk meningkatkan efisiensi dan kualitas manajemen absensi di SMK Yasfika Kalirejo. Semoga aplikasi ini dapat membantu sekolah dalam mencapai tujuan pendidikan yang lebih baik.</p>
                  <p>Terima kasih telah menggunakan Aplikasi Absensi RFID ini!</p>
                </div>
              </div>
              <!-- Tribute Card -->

              <!-- Jumlah Data -->
              <div class="row">
                <?php
                    // Lakukan query SQL untuk mengambil jumlah siswa
                    include 'koneksi.php';
                    $query = "SELECT COUNT(*) as total_siswa FROM siswa";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $jumlah_siswa = $row['total_siswa'];
                    } else {
                        // Penanganan kesalahan jika query gagal
                        $jumlah_siswa = 0; // Atau sesuaikan dengan nilai default jika diperlukan
                    }
                    ?>

                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $jumlah_siswa; ?></h3>
                                <p>Siswa</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="data_siswa.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <?php 
                        $query = "SELECT COUNT(*) as total_guru FROM guru";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $jumlah_guru = $row['total_guru'];
                        } else {
                            // Penanganan kesalahan jika query gagal
                            $jumlah_guru = 0; // Atau sesuaikan dengan nilai default jika diperlukan
                        }
                        ?>
                    <div class="col-lg-4 col-6">
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3><?php echo $jumlah_guru; ?></h3>
                          <p>Guru</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <a href="data_guru.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <?php 
                        $query = "SELECT COUNT(*) as total_kelas FROM kelas";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $jumlah_kelas = $row['total_kelas'];
                        } else {
                            // Penanganan kesalahan jika query gagal
                            $jumlah_kelas = 0; // Atau sesuaikan dengan nilai default jika diperlukan
                        }
                        ?>
                    <div class="col-lg-4 col-6">
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3><?php echo $jumlah_kelas; ?></h3>
                          <p>Kelas</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-chalkboard"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                </div>
              <!-- Jumlah Data -->

              <!-- Grafik -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Grafik Absensi Siswa</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <div id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>
                  </div>
                </div>
              </div>
              <!-- Grafik -->
            </div>
          </div>
      <!-- Main content -->