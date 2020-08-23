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
          <div class="col-lg-12 col-md-12">
          	<div class="card ">
              <div class="card-header">
				          <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modal-tambah">Tambah Saldo</button>
                  <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-tabungan">Buka Tabungan</button>
			        </div>
              <hr>
              <div class="card-header">
                <h4 class="card-title"><strong>Tabungan</strong></h4>
                <div class="alert alert-primary" role="alert">
                Total Saldo Rp. <?php echo number_format($hasil);?>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th class="text-center">Saldo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $query = "SELECT t.id_tabungan, t.id_remaja, t.nominal, r.nama_lengkap FROM tb_tabungan t INNER JOIN tb_remaja r ON t.id_remaja = r.id_remaja WHERE t.nominal IS NOT NULL ORDER BY t.id_tabungan ASC";
                      $exe = mysqli_query($conn, $query);
                      while($row = mysqli_fetch_array($exe)) {
                        ?>
                      <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo $row['nama_lengkap'];?></td>
                        <td class="text-center">Rp. <?php echo number_format(($row['nominal']));?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal modal-black fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="id_remaja">Nama Pemuda</label>
                      <select class="form-control" id="id_remaja" name="id_remaja" required="">
                        <option value="">Pilih Pemuda</option>
                        <?php
                        $query3 = mysqli_query($conn, "SELECT * FROM tb_remaja ORDER BY nama_lengkap ASC");
                        while($row3 = mysqli_fetch_array($query3)) {
                          ?>
                          <option value="<?php echo $row3['id_remaja'];?>"><?php echo $row3['nama_lengkap'];?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="deposit">Nominal</label>
                      <input type="number" name="deposit" id="deposit" class="form-control" placeholder="Nominal" required="" autocomplete="off">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                <input type="submit" class="btn btn-success" name="submitadd" value="Simpan">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal modal-black fade" id="modal-tabungan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Buka Tabungan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="id_remaja">Nama Pemuda</label>
                      <select class="form-control dropdown-black" id="id_remaja" name="id_remaja" required="">
                        <option value="">Pilih Pemuda</option>
                        <?php
                        $query3 = mysqli_query($conn, "SELECT * FROM tb_remaja ORDER BY nama_lengkap ASC");
                        while($row3 = mysqli_fetch_array($query3)) {
                          ?>
                          <option class="text-danger" value="<?php echo $row3['id_remaja'];?>"><?php echo $row3['nama_lengkap'];?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="deposit">Nominal</label>
                      <input type="number" name="deposit" id="deposit" class="form-control" placeholder="Nominal" required="" autocomplete="off">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                <input type="submit" class="btn btn-success" name="submittab" value="Simpan">
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php include('footer.php'); ?>
  </div>
  <!-- Sidebar Background -->
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
  <?php
	include 'koneksi.php';
	// tambah saldo tabungan
  if(isset($_POST['submitadd'])) {
    date_default_timezone_set('Asia/Jakarta');

    $id_remaja = $_POST['id_remaja'];
    $deposit = $_POST['deposit'];
    $created = date("Y-m-d H:i:s");
    $modified = date("Y-m-d H:i:s");
    $keterangan = "Deposit Saldo";

    $depo = mysqli_query($conn, "SELECT nominal FROM tb_tabungan WHERE id_remaja = $id_remaja");

    $row4 = mysqli_fetch_array($depo);
    $nominal = $row4['nominal'] + $deposit;

    /*$query = "INSERT INTO tb_tabungan SET id_remaja = '$id_remaja', deposit = '$deposit', saldo = '$saldo', created = '$created', modified = '$modified'";*/
    
    // menambahkan deposit ke table transaki
    $query1 = "INSERT INTO tb_transaksi(id_remaja, masuk, keterangan, created, modified) VALUES('$id_remaja', '$deposit', '$keterangan', '$created', '$modified')";
    $exe2 = mysqli_query($conn, $query1);

    // menambahkan saldo
    //$query2 = "INSERT INTO tb_tabungan(id_remaja, nominal, created, modified) VALUES('$id_remaja', '$nomi')";
    // update nominal saldo setelah deposit
    $query5 = "UPDATE tb_tabungan SET nominal = '$nominal' WHERE id_remaja = '$id_remaja'";
    $exe5 = mysqli_query($conn, $query5);

    if ($exe5) {  
      if($exe2) {
        echo "<script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });
        Toast.fire({
          icon: 'success',
          title: 'Berhasil menambahkan saldo'
        }).then(function() {
          window.location.href='tabungan'
        });
        </script>";
      } else {
        echo "<script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });
      Toast.fire({
        icon: 'error',
        title: 'Gagal menambah saldo'
      })
      </script>";
      }
    } else {
      echo "<script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });
      Toast.fire({
        icon: 'error',
        title: 'Gagal menambah saldo'
      })
      </script>"; 
    }
  }
	?>
</body>

</html>






