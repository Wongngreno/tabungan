    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            <img src="assets/img/favicon.png" alt="">
          </a>
          <a href="javascript:void(0)" class="simple-text font-weight-bold logo-normal">
            Tabungan Ngreno
          </a>
        </div>
        <ul class="nav">
          <li class="active ">
            <a href="beranda">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard
              </p>
            </a>
          </li>
          <li>
            <a href="anggota">
              <i class="tim-icons fas fa-user"></i>
              <p>Anggota<span class="badge badge-default float-right"><?php echo $anggota['anggota'];?></span>
              </p>
            </a>
          </li>
          <li>
            <a href="tabungan">
              <i class="tim-icons fas fa-wallet"></i>
              <p>Tabungan<span class="badge badge-default float-right"><?php echo $tabungan['tabungan'];?></span>
              </p>
            </a>
          </li>
          <li>
            <a href="kegiatan">
              <i class="tim-icons fas fa-handshake"></i>
              <p>Kegiatan<span class="badge badge-default float-right"><?php echo $kegiatan['kegiatan'];?></span>
              </p>
            </a>
          </li>
          <li class="active">
            <a href="laporan">
              <i class="tim-icons icon-spaceship"></i>
              <p>Laporan</p>
            </a>
          </li>
          <li>
            <a href="pengumuman">
              <i class="tim-icons icon-bell-55"></i>
              <p>Pengumuman<span class="badge badge-default float-right"><?php echo $pengumuman['pengumuman'];?></span>
              </p>
            </a>
          </li>
          <li>
            <a href="gagasan">
              <i class="tim-icons icon-world"></i>
              <p>Ide dan Gagasan</p>
            </a>
          </li>
          <li>
            <a href="pengaduan">
              <i class="tim-icons icon-pin"></i>
              <p>Pengaduan Masyarakat</p>
            </a>
          </li>
          <li>
            <a href="market">
              <i class="tim-icons fas fa-store"></i>
              <p>Marketplace<span class="badge badge-danger float-right"><?php echo $market['market'];?></span>
              </p>
            </a>
          </li>
        </ul>
      </div>
    </div>