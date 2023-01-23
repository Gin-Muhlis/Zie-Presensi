<?php
require "../../functions/functions.php"; // !memanggil file functions.php

checkSession("login_siswa"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
  $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
  $nama = $_SESSION["nama"]; // !menyimpan value dari session dengan nama nama kedalam variabel

  foreach ($table_database as $table) { // !me looping array nama table
    $result = mysqli_query($conn, "SELECT * FROM $table WHERE nama = '$nama'"); // !membuat query untuk mengambil data dari database yang sesuai dengan variabel nama

    if (mysqli_num_rows($result) === 1) { // !mengecek apakah variabel $result ada isinya
      $dataUser = mysqli_fetch_assoc($result); // !simpan data yang sesuai kedalam variabel dataUser
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/base.css">
  <link rel="stylesheet" href="../../css/sidebar.css">
  <link rel="stylesheet" href="../../css/absensi.css">
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
      <div class="menu">
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
        <a href="../logout.php">Keluar</a>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="wrapper">
      <h1>Absensi Kehadiran Siswa</h1>
      <form action="#">
        <label class="field">
          <span class="label">Nama</span>
          <span class="two-point">:</span>
          <input type="text" name="nama" id="nama" autocomplete="off" value="Gin Gin Nurilham Muhlis" disabled>
        </label>
        <label class="field">
          <span class="label">NIS</span>
          <span class="two-point">:</span>
          <input type="text" name="nis" id="nis" autocomplete="off" value="78673423" disabled>
        </label>
        <div id="status">
          <span class="status-field label">Status</span>
          <span class="two-point">:</span>
          <div class="jenis-status">
            <label for="hadir">
              <span class="label">Hadir</span>
              <input type="radio" name="status" id="hadir" value="hadir">
            </label>
            <label for="izin">
              <span class="label">Izin</span>
              <input type="radio" name="status" id="izin" value="izin">
            </label>
            <label for="sakit">
              <span class="label">Sakit</span>
              <input type="radio" name="status" id="sakit" value="sakit">
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
    </div>
  </div>
</body>

</html>