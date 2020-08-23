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
            <div class="card"  style="background-color: #3617ad">
              <div class="card-body">
                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modal-upload">Tambah</button>
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-delete">Hapus</button>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <?php
          $no = 1;
          $query = "SELECT * FROM tb_pengumuman ORDER BY id_pengumuman DESC";
          $exe = mysqli_query($conn, $query);
          while($row = mysqli_fetch_array($exe)) {
          ?>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header" style="background-color: #3617ad">
                <h3 align="center"><?php echo $row['nama'];?></h3>
              </div>
              <div class="card-body" style="background-color: #040124">
                <p class="text-light" style="padding: 1rem">Diupload pada: <?php echo $row['created'];?></p>
                <h4 class="card-text" style="padding: 1rem"><?php echo $row['post'];?></h4>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
        <div class="modal modal-black fade" id="modal-delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Hapus Pengumuman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="" method="POST" enctype="multipart/form-data" class="data-edit">
                <div class="modal-body" id="modal-edit">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="id_pengumuman">Nama </label>
                        <select class="form-control" id="id_pengumuman" name="id_pengumuman" required="">
                          <option value="">Pilih Nama</option>
                          <?php
                          $data_hapus = mysqli_query($conn, "SELECT * FROM tb_pengumuman ORDER BY id_pengumuman ASC");
                          while($hapus = mysqli_fetch_array($data_hapus)) {
                            ?>
                            <option value="<?php echo $hapus['id_pengumuman'];?>"><?php echo $hapus['nama'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                  <input type="submit" class="btn btn-success" name="submithapus" value="Hapus">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal modal-black fade" id="modal-upload">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Tambah Pengumuman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="nama">Nama/Judul</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama atau Judul" required="" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="deskripsi">Deskripsi Pengumuman</label>
                        <textarea name="deskripsi" id="deskripsi" class="ckeditor" placeholder="deskripsi" required="" autocomplete="off"></textarea>
                      </div>
                    </div>
                  </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                  <input type="submit" class="btn btn-success" name="submittambah" value="Tambah">
                </div>
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
    $(document).ready(function() {
    $('.summernote').summernote();
    });
  </script>
  <!-- PHP -->
  <?php 
  // upload barang
  include 'koneksi.php';
  if (isset($_POST['submittambah'])) {
    date_default_timezone_set('Asia/Jakarta');

    
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $created = date("Y-m-d H:i:s");
    $modified = date("Y-m-d H:i:s");

    $query = "INSERT INTO tb_pengumuman(nama, post, created, modified) VALUES('$nama', '$deskripsi', '$created', '$modified')";
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
                title: 'Berhasil tambah pengumuman'
            }).then(function() {
                window.location.href='pengumuman'
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
        title: 'Gagal tambah pengumuman'
      })
      </script>";   
    }
  }
  if(isset($_POST['submithapus'])) {

    $id_pengumuman = $_POST['id_pengumuman'];

    $query = "DELETE FROM tb_pengumuman WHERE id_pengumuman = $id_pengumuman";
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
        title: 'Berhasil menghapus pengumuman'
      }).then(function() {
        window.location.href='pengumuman'
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
        title: 'Gagal menghapus pengumuman'
      })
      </script>";   
    }
  }
  ?>


</body>
</html>