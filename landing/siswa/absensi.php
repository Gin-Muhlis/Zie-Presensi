<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_absensi.php"; // !memanggil file function_absensi.php

checkSession("login_siswa"); // !menjalankan fungsi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
  $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
  $dataUser = getDataFromSession();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../css/base.css">
  <link rel="stylesheet" href="../../css/sidebar.css">
  <link rel="stylesheet" href="../../css/styleAbsensi.css">
  <title>halaman absensi</title>
</head>

<body>
  <div class="sidebar">
    <div class="head-sidebar">
      <div class="image-profile">
        <img src="../../image/profile.jpg" alt="image-profile">
      </div>
      <div class="name-profile">
        <h2><?= $dataUser["nama"] ?></h2>
      </div>
      <div class="class-profile">
        <p><?= $dataUser["level"] ?></p>
      </div>
    </div>
    <div class="body-sidebar">
      <div class="menu">
        <a href="siswa.php">Home</a>
      </div>
      <div class="menu" id="active">
        <a href="#">Absensi</a>
      </div>
      <div class="menu">
        <a href="#">Jadwal Pelajaran</a>
      </div>
      <div class="menu">
        <a href="#">Edit Data</a>
      </div>
    </div>
    <div class="footer-sidebar">
      <div class="menu-logout">
        <a href="../../logout.php">Keluar</a>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="wrapper">
      <h1>Absensi Kehadiran Siswa</h1>
      <?php if (isset($done) || isset($_COOKIE["absen"])) : ?>
        <div class="message">
          <i class="fa-solid fa-thumbs-up"></i>
          <p>Terimaksih Telah mengisi Absensi</p>
        </div>
      <?php else : ?>
        <form action="#" method="POST">
          <label class="field disable">
            <span class="label">Nama</span>
            <span class="two-point">:</span>
            <input type="text" name="nama" id="nama" autocomplete="off" value="<?= $dataUser["nama"] ?>">
          </label>
          <label class="field disable">
            <span class="label">Kelas</span>
            <span class="two-point">:</span>
            <input type="text" name="kelas" id="kelas" autocomplete="off" value="<?= $dataUser["kode"] ?>">
          </label>
          <label class="field disable">
            <span class="label">No Absen</span>
            <span class="two-point">:</span>
            <input type="text" name="no_absen" id="no_absen" autocomplete="off" value="<?= $dataUser["no_absen"] ?>">
          </label>
          <div id="status">
            <span class="status-field label">Status</span>
            <span class="two-point">:</span>
            <div class="jenis-status">
              <label for="hadir">
                <span class="label">Hadir</span>
                <input type="radio" name="status" id="hadir" value="hadir" required>
              </label>
              <label for="izin">
                <span class="label">Izin</span>
                <input type="radio" name="status" id="izin" value="izin" required>
              </label>
              <label for="sakit">
                <span class="label">Sakit</span>
                <input type="radio" name="status" id="sakit" value="sakit" required>
              </label>
            </div>
          </div>
          <label for="keterangan">
            <div class="field keterangan-field">
              <span class="label">keterangan</span>
              <span class="two-point">:</span>
            </div>
            <textarea name="keterangan" id="keterangan"></textarea>
          </label>
          <div class="button-area">
            <button type="submit" name="kirim-absensi">Kirim</button>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </div>



</body>

</html>