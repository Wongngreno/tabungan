<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Uwuh Widodo">
  <title>Pemuda Karang Taruna Dusun Ngreno</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/favicon.png" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>
<body class="bg-dark">
	<?php include('nav-login.php'); ?>
	<div class="main-content">
    	<!-- Header -->
	    <div class="header bg-gradient-danger py-7 py-lg-8 pt-lg-9">
	      	<div class="container">
	        	<div class="header-body text-center mb-7">
	          		<div class="row justify-content-center">
	            	<div class="col-xl-5 col-lg-6 col-md-8 px-5">
	              	<h1 class="text-white" style="font-weight: 800; letter-spacing: .1rem">Welcome!</h1>
	              	<p class="text-lead text-white" style="font-weight: 800">Pemuda Karang Taruna Dusun Ngreno</p>
	            	</div>
	          		</div>
	        	</div>
	      	</div>
	    </div>
	    <!-- Page content -->
	    <div class="container mt--8 pb-5">
	      <div class="row justify-content-center">
	        <div class="col-lg-5 col-md-7">
	          	<div class="card bg-secondary border-0 mb-0">
	            	<div class="card-header bg-transparent pb-5">
	                	<img class="card-img-top" src="assets/img/ngreno.jpg" alt="">
	              	</div>
	            	<div class="card-body px-lg-5 py-lg-5">
	              	<div class="text-center text-muted mb-4">
		                <h1>
		                  	<?php
		                      date_default_timezone_set('Asia/Jakarta');
		                      $time = time();
		                      $hour = date("G", $time);

		                      if($hour >= 0 && $hour <= 10) {
		                        echo "Selamat Pagi";
		                      }else if($hour >= 11 && $hour <= 14) {
		                        echo "Selamat Siang";
		                      }else if($hour >= 15 && $hour <= 17) {
		                        echo "Selamat Sore";
		                      }else if($hour >= 18 && $hour <= 24) {
		                        echo "Selamat Malam";
		                      }else {
		                        echo "Selamat Datang";
		                      }
		                  	?>
		                </h1>
	              	</div>
	              	<form action="" method="POST">
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Nama Pengguna" name="username" id="username" required="" pattern="[A-Za-z0-9]+" autocomplete="off">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-user text-danger"></span>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="password" class="form-control" placeholder="Kata Sandi" name="password" id="password" required="" pattern="[A-Za-z0-9]+" autocomplete="off">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<input type="submit" name="submit" id="submit" value="Masuk" class="btn btn-danger btn-block">
							</div>
						</div>
					</form>
	             	</div>
	          	</div>
	        </div>
	      </div>
	    </div>
  	</div>
  	<?php include('footer.php'); ?>
   	<!-- Core -->
   	<script src="assets/plugins/jquery/jquery.min.js"></script>
   	<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
   	<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   	<script src="assets/vendor/js-cookie/js.cookie.js"></script>
   	<script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
   	<script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
   	<!-- Argon JS -->
   	<script src="assets/js/argon.js?v=1.2.0"></script>
   	<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
   	<script src="assets/plugins/toastr/toastr.min.js"></script>
   	<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
   	<script src="assets/plugins/sweet-alert2/dist/sweetalert2.all.min.js"></script>
   	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
   	<script src="assets/plugins/sweet-alert2/dist/sweetalert2.min.js"></script>
	<?php
	
	include 'koneksi.php';
	if(isset($_POST['submit'])) {
		$username = mysqli_escape_string($conn, $_POST['username']);
		$password = mysqli_escape_string($conn, $_POST['password']);

		$query = mysqli_query($conn, "SELECT * FROM tb_pengguna WHERE BINARY username = '$username'");
		$cek = mysqli_num_rows($query);

		if($cek > 0) {
			$data = mysqli_fetch_array($query);
			$nama = $data['nama_lengkap'];
			$id_pengguna = $data['id_pengguna'];
			$username1 = $data['username'];
			if(password_verify($password, $data['password'])) {
				setcookie('version', $id_pengguna, time() + (60 * 60 * 24 * 5), '/');
				echo "<script>
				localStorage.setItem('id_pengguna', '$id_pengguna');
				localStorage.setItem('nama', '$nama');
				localStorage.setItem('username', '$username1'); 
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000
				});
				Toast.fire({
					icon: 'success',
					title: '&nbsp;Selamat datang '+'$username1'+' di Aplikasi Pemuda Karang Taruna Dusun Ngreno'
				}).then(function() {
					window.location.href='beranda'
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
					title: '&nbsp;Kata sandi yang Anda masukkan salah'
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
				title: '&nbsp;Nama pengguna serta kata sandi yang Anda masukkan tidak cocok'
			})
			</script>";
		}
	}
	?>
</body>
</html>