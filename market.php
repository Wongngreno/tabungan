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
            <div class="card" style="background-color: #3617ad">
              <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-upload">Pasang Iklan</button>
              </div>
            </div>
          </div>
        </div>
        <!--<iframe data-aa="1457386" src="//acceptable.a-ads.com/1457386" scrolling="no" style="border:0px; padding:0; width:100%; height:100%; overflow:hidden; border-radius: 5px" allowtransparency="true"></iframe>-->
        <div class="row">
          <?php
          $no = 1;
          $query = "SELECT * FROM tb_market JOIN tb_remaja ON tb_market.id_penjual = tb_remaja.id_remaja ORDER BY id_barang DESC";
          $exe = mysqli_query($conn, $query);
          while($row = mysqli_fetch_array($exe)) {
          ?>
          <div class="col-lg-4">
            <div class="card card-chart" style="background-color: #040124">
              <div class="card-header">
                <h3 align="center"><?php echo $row['nama_barang'];?></h3>
              <img class="card-img-top" src="img-market/<?php echo $row['gambar_barang'];?>" alt="marketplace">
              </div>
              <div class="card-body" style="padding-left: 1rem">
                <h1>Rp. <?php echo number_format($row['harga']);?></h1>
                <hr>
                <h4 class="card-text"><?php echo $row['deskripsi'];?></h4>
                <hr>
                <p class="card-text">Diupload pada: <?php echo $row['created'];?></p>
              </div>
              <div class="card-body">
                <a href="https://api.whatsapp.com/send?phone=<?php echo '62'.ltrim($row['no_hp'],'0');?>" class="btn btn-primary btn-block" target="_blank">WA Penjual</a>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
        <div class="modal modal-black fade" id="modal-upload">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Upload Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="barang">Nama Barang</label>
                        <input type="text" name="barang" id="barang" class="form-control" placeholder="nama barang" required="" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" placeholder="harga barang" required="" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="deskripsi">Deskripsi Barang</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="deskripsi" required="" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="gambar" class="col-md-12 col-form-label">Foto Barang</label>
                    <div class="custom-file">
                      <input type="file" name="gambar" id="gambar" class="custom-file-input">
                      <label class="custom-file-label" for="customFile"></label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                  <input type="hidden" value="<?php echo $data['id_remaja']; ?>" name="id_penjual">
                  <input type="submit" class="btn btn-success" name="submitupload" value="Upload">
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php include('footer.php'); ?>
    </div>
  </div>
  <?php include('bg.php'); ?>
  <!--   Core JS Files   -->
  <?php include('skrip.php'); ?>
  <?php include('script.php'); ?>
  <script>
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
  </script>
  <script type="text/javascript">
    (sc_adv_out = window.sc_adv_out || []).push({
        id : "695493",
        domain : "n.ads5-adnow.com"
    });
  </script>
  <script type="text/javascript" src="//st-n.ads5-adnow.com/js/a.js" async></script>
  <?php 
  // upload barang
  include 'koneksi.php';
  if (isset($_POST['submitupload'])) {
    date_default_timezone_set('Asia/Jakarta');

    $id_penjual = $_POST['id_penjual'];
    $nama_barang = $_POST['barang'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $created = date("Y-m-d H:i:s");
    $modified = date("Y-m-d H:i:s");

    move_uploaded_file($_FILES['gambar']['tmp_name'],"img-market/".$_FILES['gambar']['name']);

    $query = "INSERT INTO tb_market(id_penjual, nama_barang, harga, deskripsi, gambar_barang, created, modified) VALUES('$id_penjual', '$nama_barang', '$harga', '$deskripsi', '$gambar', '$created', '$modified')";
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
                title: 'Berhasil upload barang'
            }).then(function() {
                window.location.href='market'
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
        title: 'Gagal upload barang'
      })
      </script>";   
    }
  }
  ?>


</body>
</html>