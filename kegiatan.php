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
          <div class="col-lg-12 col-md-12">
          	<div class="card ">
              <div class="card-header">
				          <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modal-tambah">Tambah Kegiatan</button>
                  <a href="proses/cetak-kegiatan"><button type="button" class="btn btn-success float-right">Print Kegiatan</button></a>
			        </div>
              <hr class="text-primary">
              <div class="card-header">
                <h4 class="card-title"><strong>Kegiatan</strong></h4>
                <div class="alert alert-primary" role="alert">
                Total Terkumpul Rp. <?php echo number_format($kegiatan_terkumpul['kegiatan']);?>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th class="text-center">Nominal</th>
                        <th class="text-center">Terkumpul</th>
                        <th>Dibuat</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $query = "SELECT * FROM tb_kegiatan ORDER BY id_kegiatan ASC";
                      $exe = mysqli_query($conn, $query);
                      while($row = mysqli_fetch_array($exe)) {
                        ?>
                      <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo $row['nama'];?></td>
                        <td class="text-center">Rp. <?php echo number_format(($row['nominal']));?></td>
                        <td class="text-center">Rp. <?php echo number_format(($row['terkumpul']));?></td>
                        <td><?php echo $row['created'];?></td>
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
                      <label for="id_remaja">Nama Kegiatan</label>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kegiatan" required="" autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nominal">Nominal</label>
                      <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Nominal" required="" autocomplete="off" min="500" max="<?php echo $row3['tabungan'];?>">
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