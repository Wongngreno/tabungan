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
          <div class="col-xl">
            <div class="card">
              <div class="card-body text-center">
                <button type="button" class="btn btn-primary">Ide dan Gagasan</button>
              </div>
            </div>
          </div>
        </div>
        <iframe data-aa="1457386" src="//acceptable.a-ads.com/1457386" scrolling="no" style="border:0px; padding:0; width:100%; height:100%; overflow:hidden" allowtransparency="true"></iframe>
        <div class="row">
          <div class="col-lg-4">
            <?php
            $no = 1;
            $query = "SELECT * FROM tb_gagasan ORDER BY id_gagasan DESC";
            $exe = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($exe)) {
            ?>
            <div class="card card-chart">
              <div class="card-header">
                <h3><?php echo $row['nama'];?></h3>
              </div>
              <div class="card-body bg-dark" style="padding: .5rem 1rem">
                <p>Diupload pada: <?php echo $row['created'];?></p>
                <p><?php echo $row['deskripsi'];?></p>
              </div>
            </div>
            <?php } ?>
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
  if(isset($_POST['submitadd'])) {
    date_default_timezone_set('Asia/Jakarta');

    $nominal = $_POST['nominal'];
    $nama = $_POST['nama'];
    $created = date("Y-m-d H:i:s");
    $modified = date("Y-m-d H:i:s");

    $row1 = mysqli_query($conn, "SELECT count(*) AS jumlah_tabungan FROM tb_tabungan");
    $rows1 = mysqli_fetch_array($row1);

    $terkumpul = $rows1['jumlah_tabungan'] * $nominal;

    $query = "INSERT INTO tb_kegiatan(nama, nominal, terkumpul, created, modified) VALUES ('$nama', '$nominal', '$terkumpul', '$created', '$modified')";
    $exe = mysqli_query($conn, $query);

    $query1 = "UPDATE tb_tabungan SET nominal = nominal - $nominal";
    $exe1 = mysqli_query($conn, $query1);

    if(($exe) AND ($exe1)) {
      echo "<script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        icon: 'success',
        title: 'Berhasil menambah kegiatan'
      }).then(function() {
        window.location.href='kegiatan'
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
        title: 'Gagal menambah kegiatan'
      })
      </script>";   
    }
  }
  ?>

</body>
</html>