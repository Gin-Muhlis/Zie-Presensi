<?php
require "../../koneksi.php";
require "../../functions/login_function.php";
require "../../functions/absensi_guru_function.php";
require "../../functions/upload_image_function.php";

// cek user apakah sudah login atau belum
if (!isLoggedIn()) {
    Header("Location: ../../login.php");
    exit();
}

// cek user apakah memiliki role yang benar
if (!hasRole("walas")) {
    Header("Location: ../errorLevel.php");
    exit();
}

include("../../data/data_guru.php");


$hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");




$dataKehadiran = ambilDataKehadiran($conn, $dataUser["nama"]);

tambahKehadiran($conn, $dataKehadiran, $dataUser["id"]);

$kehadiran = cekKehadiran($conn, $dataUser["id"]);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/data_absensi.css">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.6.3.min.js"></script>
    <script src="../../js/upload.js"></script>
    <title>halaman walas</title>
</head>

<body>
    <div class="sidebar">
        <div class="head-sidebar">
            <div class="image-profile">
                <img src="../../image/<?= $dataUser["foto"] ?>" alt="image-profile">
                <div class="text-foto">
                    <span>Edit Foto</span>
                </div>
            </div>
            <div class="name-profile">
                <h2><?= $dataUser["username"] ?></h2>
            </div>
            <div class="class-profile">
                <p><?= ucwords($dataUser["role"]) ?></p>
            </div>
        </div>
        <div class="body-sidebar">
            <div class="menu">
                <a href="wali_kelas.php">Home</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Absensi</a>
            </div>
            <div class="menu">
                <a href="data_absensi.php">Absensi Kelas</a>
            </div>
            <div class="menu">
                <a href="data_agenda.php">Agenda Kelas</a>
            </div>

            <div class="menu">
                <a href="editData/editData.php">Edit Data</a>
            </div>
        </div>
        <div class="footer-sidebar">
            <div class="menu-logout">
                <a href="../../logout.php?id=<?= $dataUser["id_operator"] ?>">Keluar</a>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="wrapper">
            <div class="text-date">
                <h1>Absensi</h1>
                <p><?= $hari[date("w")] ?>, <?= date("d") ?> <?= $bulan[date("n") - 1] ?> <?= date("Y") ?></p>
            </div>
            <div class="icon-field">
                <?php if ($kehadiran !== false) : ?>
                    <i class="fas fa-smile  icon"></i>
                    <p>Anda masuk hari ini</p>
                <?php else : ?>
                    <i class="fas fa-frown icon sad"></i>
                    <p>Anda tidak masuk hari ini</p>
                <?php endif; ?>
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

    <?php if (isset($_FILES["image"])) {
        if (uploadImage($conn, $dataUser["id"], "../../image/", "../../image/{$dataUser["foto"]}") > 0) {
            echo "<script>
        alert('Foto profile berhasil diganti!')
        document.location.href = 'wali_kelas.php'
      </script>";
        }
    } ?>

</body>

</html>