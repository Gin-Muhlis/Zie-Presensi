<?php
require "../../functions/functions.php"; // !memanggil file functions.php

checkSession("login_kepala sekolah"); // !menjalankan fungi untuk mengecek session

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
  <link rel="stylesheet" href="../../css/base.css">
  <link rel="stylesheet" href="../../css/sidebar.css">
  <link rel="stylesheet" href="../../css/siswa.css">
  <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
  <script src="../../js/jquery-3.6.3.min.js"></script>
  <script src="../../js/upload.js"></script>
  <title>halaman kepala sekolah</title>
</head>

<body>
  <div class="sidebar">
    <div class="head-sidebar">
      <div class="image-profile">
        <img <?php if (strlen($dataUser["foto"]) > 0) {
                echo "src='../../image/$dataUser[foto]'";
              } else {
                echo "src='../../image/profile.jpg'";
              } ?> alt="image-profile">
        <div class="text-foto">
          <span>Edit Foto</span>
        </div>
      </div>
      <div class="name-profile">
        <h2><?= ucwords($dataUser["nama"]) ?></h2>
      </div>
      <div class="class-profile">
        <p><?= ucwords($dataUser["level"]) ?></p>
      </div>
    </div>
    <div class="body-sidebar">
      <div class="menu" id="active">
        <a href="#">Home</a>
      </div>
      <div class="menu">
        <a href="absensi_guru.php">Absensi Guru</a>
      </div>
      <div class="menu">
        <a href="absensi_siswa.php">Absensi Siswa</a>
      </div>

    </div>
    <div class="footer-sidebar">
      <div class="menu-logout">
        <a href="../../logout.php?id=<?= $dataUser["id"] ?>">Keluar</a>
      </div>
    </div>
  </div>

  <div class="wrapper-popup">
    <div class="popup">
      <form action="" method="POST" enctype="multipart/form-data">
        <label for="image">
          <i class="fa-solid fa-upload"></i>
          <span>Upload Image</span>
        </label>
        <input type="file" name="image" id="image" onchange="this.form.submit()">
      </form>
      <i class="fa-solid fa-xmark close-popup"></i>
    </div>
  </div>


  <div class="container">
    <img src="../../image/logoSmakzie.jpg" alt="logo smakzie" class="logo-image">
    <h1>Selamat Datang di Zie Presensi</h1>
    <p>Jangan lupa untuk mengisi absen setiap pagi</p>
  </div>

  <?php
  if (isset($_FILES["image"])) {
    if (uploadImage($dataUser["nama"], "../../image/$dataUser[foto]", "../../image/") > 0) {
      echo "<script>
        alert ('Foto profile berhasil diedit!');
        document.location.href = './kepala_sekolah.php';
        </script>";
    }
  }

  ?>
</body>

</html>