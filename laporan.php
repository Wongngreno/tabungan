<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
session_start();
include 'include.php';
if(!isset($_SESSION['mlebet'])) {
  header("location:index");
  exit();
}

  $userid = $_SESSION['idrem'];
  $sql = mysqli_query($conn, "SELECT * FROM tb_pengguna WHERE id_pengguna = '$userid'");
  $data = mysqli_fetch_array($sql);


include 'include.php';

$query2 = mysqli_query($conn, "SELECT SUM(nominal) AS nominal FROM tb_tabungan");
$row2 = mysqli_fetch_array($query2);
$hasil = $row2['nominal'];
?>
<!DOCTYPE html>
<html lang="en">

<?php
include('head.php');
?>
<body class="">
  <div class="wrapper">
    <?php include('sidebar.php'); ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include('navbar.php'); ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Laporan</h5>
                    <h2 class="card-title"> Statistik</h2>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="myChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT created, SUM(nominal) AS total FROM tb_tabungan GROUP BY WEEK(created)");
                $row = mysqli_fetch_array($query);
                ?>
                <h5 class="card-category">Laporan Mingguan</h5>
                <h3 class="card-title"><i class="tim-icons icon-coins text-primary"></i>Rp. <?php echo number_format($row['total']);?></h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="myChartWeek"></canvas>
                </div>
              </div>
              <div class="card-body">
                <a href="" class="btn btn-primary btn-block">Print</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT created, SUM(nominal) AS total FROM tb_tabungan GROUP BY MONTH(created)");
                $row = mysqli_fetch_array($query);
                ?>
                <h5 class="card-category">Laporan Mingguan</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i>Rp. <?php echo number_format($row['total']);?></h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="myChartMount"></canvas>
                </div>
              </div>
              <div class="card-body">
                <a href="" class="btn btn-info btn-block">Print</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT created, SUM(nominal) AS total FROM tb_tabungan GROUP BY YEAR(created)");
                $row = mysqli_fetch_array($query);
                ?>
                <h5 class="card-category">Laporan Tahunan</h5>
                <h3 class="card-title"><i class="tim-icons icon-send text-success"></i>Rp. <?php echo number_format($row['total']);?></h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="myChartYear"></canvas>
                </div>
              </div>
              <div class="card-body">
                <a href="" class="btn btn-success btn-block">Print</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include('footer.php'); ?>
    </div>
  </div>
  <?php include('bg.php'); ?>
  <!--   Core JS Files   -->
  <?php include('skrip.php'); ?>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>
  <script>
    <?php
    $query = mysqli_query($conn, "SELECT created, SUM(nominal) AS total FROM tb_tabungan GROUP BY WEEK(created)");

    $data_tanggal = array();
    $data_total = array();

    while($row = mysqli_fetch_array($query)) {
          $data_tanggal[] = date('d-m-Y', strtotime($row['created'])); // Memasukan tanggal ke dalam array
          $data_total[] = $row['total']; // Memasukan total ke dalam array
    }
    ?>
    var ctx = document.getElementById("myChartWeek").getContext('2d');
    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
    gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($data_tanggal);?>,
        datasets: [{
          label: 'Grafik Mingguan',
          data: <?php echo json_encode($data_total);?>,
          backgroundColor: gradientStroke,
          borderColor: "#d346b1",
          pointHoverBorderWidth: 15,
          borderWidth: 2
        }]
      },
      options: gradientBarChartConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 120,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    }
    });
  </script>
  <script>
    <?php
    $query = mysqli_query($conn, "SELECT created, SUM(masuk) AS total, SUM(keluar) AS keluar FROM tb_transaksi GROUP BY DAY(created)");

    $data_tanggal = array();
    $data_total = array();
    $data_keluar = array();

    while($row = mysqli_fetch_array($query)) {
          $data_tanggal[] = date('d-m-Y', strtotime($row['created'])); // Memasukan tanggal ke dalam array
          $data_total[] = $row['total']; // Memasukan total ke dalam array
          $data_keluar[] = $row['keluar'];
    }
    ?>
    var ctx = document.getElementById('myChart').getContext("2d")
    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
    gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($data_tanggal);?>,
        datasets: [{
            label: "Pemasukan",
            borderColor: '#00d6b4',
            borderDash: [],
            borderDashOffset: 0.0,
            backgroundColor: gradientStroke,
            pointBorderColor: 'rgba(255,255,255,0)',
            pointBackgroundColor: '#d346b1',
            pointHoverBackgroundColor: '#d346b1',
            pointHoverBorderColor: '#d346b1',
            pointBorderWidth: 10,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,
            fill: true,
            borderWidth: 2,
            data: <?php echo json_encode($data_total);?>
        },
        {
            label: "Pengeluaran",
            borderColor: "#d346b1",
            borderDash: [],
            borderDashOffset: 0.0,
            backgroundColor: gradientStroke,
            pointBorderColor: 'rgba(255,255,255,0)',
            pointBackgroundColor: '#d346b1',
            pointHoverBackgroundColor: '#d346b1',
            pointHoverBorderColor: '#d346b1',
            pointBorderWidth: 10,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,
            fill: true,
            borderWidth: 2,
            data: <?php echo json_encode($data_keluar);?>
        }]
        
    },
    options: gradientBarChartConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 120,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    }
  });
  </script>
  <script>
    <?php
    $query = mysqli_query($conn, "SELECT created, SUM(nominal) AS total FROM tb_tabungan GROUP BY MONTH(created)");

    $data_tanggal = array();
    $data_total = array();

    while($row = mysqli_fetch_array($query)) {
          $data_tanggal[] = date('d-m-Y', strtotime($row['created'])); // Memasukan tanggal ke dalam array
          $data_total[] = $row['total']; // Memasukan total ke dalam array
    }
    ?>
    var ctx = document.getElementById("myChartMount").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
    gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors


    var myChart = new Chart(ctx, {
      type: 'bar',
      responsive: true,
      data: {
        labels: <?php echo json_encode($data_tanggal);?>,
        datasets: [{
          label: "Bulanan",
          fill: true,
          backgroundColor: gradientStroke,
          hoverBackgroundColor: gradientStroke,
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: <?php echo json_encode($data_total);?>,
        }]
      },
      options: gradientBarChartConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 120,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    }
    });
  </script>
  <script>
    <?php
    $query = mysqli_query($conn, "SELECT created, SUM(nominal) AS total FROM tb_tabungan GROUP BY YEAR(created)");

    $data_tanggal = array();
    $data_total = array();

    while($row = mysqli_fetch_array($query)) {
          $data_tanggal[] = date('d-m-Y', strtotime($row['created'])); // Memasukan tanggal ke dalam array
          $data_total[] = $row['total']; // Memasukan total ke dalam array
    }
    ?>
    var ctx = document.getElementById("myChartYear").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
    gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)'); //green colors
    gradientStroke.addColorStop(0, 'rgba(66,134,121,0)'); //green colors


    var myChart = new Chart(ctx, {
      type: 'bar',
      responsive: true,
      data: {
        labels: <?php echo json_encode($data_tanggal);?>,
        datasets: [{
          label: "Tahunan",
          fill: true,
          backgroundColor: gradientStroke,
          hoverBackgroundColor: gradientStroke,
          borderColor: '#00d6b4',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: <?php echo json_encode($data_total);?>,
        }]
      },
      options: gradientBarChartConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 120,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    }
    });
  </script>
</body>

</html>