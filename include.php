<?php
include 'koneksi.php';
include('lang.php');


$anggota_row = mysqli_query($conn, "SELECT COUNT(*) AS anggota FROM tb_remaja");
$anggota = mysqli_fetch_array($anggota_row);

$tabungan_row = mysqli_query($conn, "SELECT COUNT(*) AS tabungan FROM tb_tabungan");
$tabungan = mysqli_fetch_array($tabungan_row);

$kegiatan_row = mysqli_query($conn, "SELECT COUNT(*) AS kegiatan FROM tb_kegiatan");
$kegiatan = mysqli_fetch_array($kegiatan_row);

$sum_tabungan = mysqli_query($conn, "SELECT SUM(nominal) AS nominal FROM tb_tabungan");
$hasil = mysqli_fetch_array($sum_tabungan);

$sum_kegiatan = mysqli_query($conn, "SELECT SUM(terkumpul) AS kegiatan FROM tb_kegiatan");
$kegiatan_terkumpul = mysqli_fetch_array($sum_kegiatan);

$count_pengumuman = mysqli_query($conn, "SELECT COUNT(*) AS pengumuman FROM tb_pengumuman");
$pengumuman = mysqli_fetch_array($count_pengumuman);

$sum_market = mysqli_query($conn, "SELECT COUNT(*) AS market FROM tb_market");
$market = mysqli_fetch_array($sum_market);
?>