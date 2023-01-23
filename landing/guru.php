<?php
require "../functions/functions.php"; // !memanggil file functions.php

checkSession("login_guru"); // !menjalankan fungi untuk mengecek session

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
  <link rel="stylesheet" href="../css/siswa.css">
  <title>halaman siswa</title>
</head>

<body>
  <div class="sidebar">
    <div class="head-sidebar">
      <div class="image-profile">
        <img src="../image/profile.jpg" alt="image-profile">
      </div>
      <div class="name-profile">
        <h2><?= $dataUser["nama"] ?></h2>
      </div>
      <div class="class-profile">
        <p><?= $dataUser["kelas"] ?></p>
      </div>
    </div>
    <div class="body-sidebar">
      <div class="menu">
        <a href="#">Isi Absensi</a>
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
    <img src="../image/logoSmakzie.jpg" alt="logo smakzie" class="logo-image">
    <h1>Selamat Datang di Zie Presensi</h1>
    <p>Jangan lupa untuk mengisi absen setiap pagi</p>
  </div>
</body>

</html>