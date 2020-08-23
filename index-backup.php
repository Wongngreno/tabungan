<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
</<?php 
include('lang.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Uwuh Widodo">
  <title><?php echo $title;?></title>
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
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="dashboard.html">
        <img src="assets/img/favicon.png">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="/">
                <img src="assets/img/favicon.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="admin" class="nav-link">
              <span class="nav-link-inner--text">Admin</span>
            </a>
          </li>
        </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav mr-auto">
          <li class="nav-item d-lg-block ml-lg-4">
            <a href="login" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
                <i class="fas fa-user mr-2"></i>
              </span>
              <span class="nav-link-inner--text">Login</span>
            </a>
          </li>
        </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.facebook.com/creativetim" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
              <i class="fab fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">Facebook</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
              <i class="fab fa-instagram"></i>
              <span class="nav-link-inner--text d-lg-none">Instagram</span>
            </a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-indigo py-7 py-lg-8 pt-lg-9">
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
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0">
            <div class="card-header bg-transparent pb-5">
              <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="assets/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
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
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0">
            <div class="card-header bg-transparent pb-5">
              <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="assets/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            Copyright &copy; 2020 <a href="beranda" class="font-weight-bold ml-1" target="_blank">Karang Taruna Dusun Ngreno</a>
          </div>
          <div class="copyright text-center text-xl-left text-muted">
            <?php echo $author_bottom;?>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Our Tim</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
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