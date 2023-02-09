<?php
require "../../functions/functions.php"; // !memanggil file functions.php

checkSession("login_bk"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/konsultasi.css">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.6.3.min.js"></script>
    <script src="../../js/upload.js"></script>
    <title>halaman wali kelas</title>
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
                <p><?= strtoupper($dataUser["level"]) ?></p>
            </div>
        </div>
        <div class="body-sidebar">
            <div class="menu">
                <a href="bk.php">Home</a>
            </div>
            <div class="menu">
                <a href="absensi.php">Absensi</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Konsultasi Siswa</a>
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
        <div class="wrapper">
            <h1>Catatan Konsultasi Siswa</h1>
            <form action="" class="filter-field">
                <select name="bulan" id="bulan">
                    <?php for ($i = 0; $i < count($bulan); $i++) : ?>
                        <option value="<?= $i + 1 ?>"><?= $bulan[$i] ?></option>
                    <?php endfor; ?>
                </select>

                <a href="tambahCatatan.php">Tambah Catatan</a>
            </form>
            <div class="catatan">
                <div class="row">
                    <h3>Gin Gin Nurilham Muhlis</h3>
                    <p>2023-01-909</p>
                    <i class="fa-sharp fa-solid fa-arrow-right detail"></i>
                </div>
                <div class="row">
                    <h3>Gin Gin Nurilham Muhlis</h3>
                    <p>2023-01-909</p>
                    <i class="fa-sharp fa-solid fa-arrow-right detail"></i>
                </div>
                <div class="row">
                    <h3>Gin Gin Nurilham Muhlis</h3>
                    <p>2023-01-909</p>
                    <i class="fa-sharp fa-solid fa-arrow-right detail"></i>
                </div>
                <div class="row">
                    <h3>Gin Gin Nurilham Muhlis</h3>
                    <p>2023-01-909</p>
                    <i class="fa-sharp fa-solid fa-arrow-right detail"></i>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_FILES["image"])) {
        if (uploadImage($dataUser["nama"], "../../image/$dataUser[foto]", "../../image/") > 0) {
            echo "<script>
        alert ('Foto profile berhasil diedit!');
        document.location.href = './konsultasi.php';
        </script>";
        }
    }

    ?>

</body>

</html>