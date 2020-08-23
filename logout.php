<?php
session_start(); // memulai session
session_unset();
session_destroy(); // menghapus session
header("index");

setcookie("version", "", time() + (60 * 60 * 24 * 5), '/');
echo "<script>
localStorage.removeItem('id_pengguna');
localStorage.removeItem('username');
localStorage.removeItem('nama');
window.location.href='index';
</script>";
?>