<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Absensi V1</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!-- dashboard -->
        <li class="nav-item">
          <a href="index.php" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <!-- dashboard -->
        <li class="nav-item menu-close">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Siswa
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="data_siswa.php" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Data Siswa</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="impor_siswa.php" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Import Data Siswa</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Kelas -->
        <li class="nav-item">
          <a href="data_kelas.php" class="nav-link">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Kelas
            </p>
          </a>
        </li>

        <!-- Guru -->
        <li class="nav-item">
          <a href="data_guru.php" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Guru
            </p>
          </a>
        </li>

        <!-- Lapora -->
        <li class="nav-item">
          <a href="data_laporan.php" class="nav-link">
            <i class="nav-icon fas fa-file-pdf"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>