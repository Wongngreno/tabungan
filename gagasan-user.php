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
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                  <h3 class="text-header">Ide dan Gagasan</h3>
                </div>
            </div>
            <div class="alert alert-info">
              <p>Ayo kawan! Berikan ide dan gagasan terbaikmu untuk kemajuan dan perbaikan desa Ngreno Tercinta.</p>
            </div>
          </div>
          <div class="col-lg-12">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="judul">Nama atau Judul</label>
                    <input name="judul" id="judul" class="form-control" placeholder="Nama judul" required="" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi Pengumuman</label>
                    <textarea name="deskripsi" id="deskripsi" class="ckeditor" placeholder="deskripsi" required="" autocomplete="off"></textarea>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <button type="submit" name="submit" id="submit" class="btn btn-success float-right">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php include('footer.php'); ?>        
    </div>
  </div>
  <!-- Sidebar Background -->
  <?php include('bg.php'); ?>
  <!--   Core JS Files   -->
  <?php include('skrip.php'); ?>
  <?php include('script.php'); ?>
  <!-- tambah tabungan -->
  <?php
  include 'koneksi.php';
  if(isset($_POST['submit'])) {
    date_default_timezone_set('Asia/Jakarta');

    $nama = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $created = date("Y-m-d H:i:s");
    $modified = date("Y-m-d H:i:s");

    $query = "INSERT INTO tb_gagasan(nama, deskripsi, created, modified) VALUES ('$nama', '$deskripsi', '$created', '$modified')";
    $exe = mysqli_query($conn, $query);

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
        title: 'Berhasil mengirim gagasan.<br>Terima kasih atas ide dan gagasannya'
      }).then(function() {
        window.location.href='gagasan-user'
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
        title: 'Gagal mengirim'
      })
      </script>";   
    }
  }
  ?>

</body>
</html>