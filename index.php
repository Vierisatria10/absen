<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/uplot/uPlot.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include 'navbar.php' ?>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <!-- Content Header -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- Content Header -->
            <div class="content">
        <div class="container-fluid">

      <?php include 'konten_dashboard.php' ?>
    </div>
    <!-- Content Wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- Control Sidebar -->

    <!-- Main Footer -->
   
  </div>

</div>
<?php include'footer.php' ?>
</div>
  <!-- Wrapper -->

  <!-- Required Scripts -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/uplot/uPlot.iife.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="dist/js/demo.js"></script>
  <script>
    // JavaScript untuk menginisialisasi dan mengatur grafik
    $(function () {
      /* uPlot
       * -------
       * Di sini kami akan membuat beberapa grafik menggunakan uPlot
       */

      function getSize(elementId) {
        return {
          width: document.getElementById(elementId).offsetWidth,
          height: document.getElementById(elementId).offsetHeight,
        }
      }

      let data = [
        [0, 1, 2, 3, 4, 5, 6],
        [28, 48, 40, 19, 86, 27, 90],
        [65, 59, 80, 81, 56, 55, 40]
      ];

      //--------------
      //- GRAFIK AREA -
      //--------------

      const optsAreaChart = {
        ...getSize('areaChart'),
        scales: {
          x: {
            time: false,
          },
          y: {
            range: [0, 100],
          },
        },
        series: [
          {},
          {
            fill: 'rgba(60,141,188,0.7)',
            stroke: 'rgba(60,141,188,1)',
          },
          {
            stroke: '#c1c7d1',
            fill: 'rgba(210, 214, 222, .7)',
          },
        ],
      };

      let areaChart = new uPlot(optsAreaChart, data, document.getElementById('areaChart'));

      const optsLineChart = {
        ...getSize('lineChart'),
        scales: {
          x: {
            time: false,
          },
          y: {
            range: [0, 100],
          },
        },
        series: [
          {},
          {
            fill: 'transparent',
            width: 5,
            stroke: 'rgba(60,141,188,1)',
          },
          {
            stroke: '#c1c7d1',
            width: 5,
            fill: 'transparent',
          },
        ],
      };

      let lineChart = new uPlot(optsLineChart, data, document.getElementById('lineChart'));

      window.addEventListener("resize", e => {
        areaChart.setSize(getSize('areaChart'));
        lineChart.setSize(getSize('lineChart'));
      });
    })
  </script>
</body>
</html>
