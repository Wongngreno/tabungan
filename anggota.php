<?php

include 'include.php';

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
				<h3 class="card-title"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">Tambah Anggota</button></h3>
			  </div>
              <div class="card-header">
                <h4 class="card-title"><strong>Anggota</strong></h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Jenis Kelamin</th>
                        <th class="text-center">Dibuat</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $query = "SELECT * FROM tb_remaja ORDER BY id_remaja ASC";
                      $exe = mysqli_query($conn, $query);
                      while($row = mysqli_fetch_array($exe)) {
                        ?>
                      <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo $row['nama_lengkap'];?></td>
                        <td><?php echo $row['no_hp'];?></td>
                        <td><?php echo $row['jenis_kelamin'];?></td>
                        <td class="text-center"><?php echo ($row['created']);?></td>
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
      <div class="modal modal-black show" id="modal-tambah">
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
										<label for="nama_lengkap">Nama Lengkap</label>
										<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required="" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="nama_lengkap">Username</label>
										<input type="text" name="username" id="username" class="form-control" placeholder="Username" required="" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="nama_lengkap">Password</label>
										<input type="text" name="password" id="password" class="form-control" placeholder="Password" required="" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="jenis_kelamin">Jenis Kelamin</label>
										<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required="">
											<option value="">Pilih Jenis Kelamin</option>
											<option value="Laki - Laki">Laki - Laki</option>
											<option value="Perempuan">Perempuan</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="nama_lengkap">No.HP aktif</label>
										<input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Nomor HP" required="" autocomplete="off">
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
	if(isset($_POST['submitadd'])) {
		date_default_timezone_set('Asia/Jakarta');

		$nama_lengkap = $_POST['nama_lengkap'];
		$username = $_POST['username'];
		$password = ($_POST['password']);
		$password_acak = password_hash($password, PASSWORD_DEFAULT);
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$no_hp = $_POST['no_hp'];
		$created = date("Y-m-d H:i:s");	
		$modified = date("Y-m-d H:i:s");

		$query = "INSERT INTO tb_remaja(nama_lengkap, username, password, no_hp, jenis_kelamin, created, modified) VALUES ('$nama_lengkap', '$username', '$password_acak', '$no_hp', '$jenis_kelamin', '$created', '$modified')";
		$exe = mysqli_query($conn, $query);

		//$query2 = "INSERT INTO tb_tabungan"

		if($exe) {
			echo "<script>
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});
			Toast.fire({
				icon: 'success',
				title: 'Berhasil menambah anggota'
			}).then(function() {
				window.location.href='anggota'
			});
			</script>";		
		}else {
			echo "<script>
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});
			Toast.fire({
				icon: 'error',
				title: 'Gagal menambah data'
			})
			</script>";		
		}
	}
	?>
</body>

</html>






