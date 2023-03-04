<?php
require "../../koneksi.php";
require "../../functions/login_function.php";
require "../../functions/walas_function.php";
require "../../functions/absensi_siswa_function.php";
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

$dataWalas = getDataWalas($conn, $dataUser["nama"]);

$dataAbsensi = getDataAbsensiSiswa($conn, $dataWalas["tingkat"], $dataWalas["rombel"], $dataWalas["kompetensi_keahlian"]);

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
            <div class="menu">
                <a href="absensi.php">Absensi</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Absensi Kelas</a>
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
            <h1 class="data-absensi">Absensi <?= $dataWalas["tingkat"] ?> <?= ucwords($dataWalas["kompetensi_keahlian"]) ?> <?= $dataWalas["rombel"] ?></h1>

            <table border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">No Absen</th>
                        <th rowspan="2">Nama Lengkap</th>
                        <th colspan="3">Kehadiran</th>
                    </tr>
                    <tr>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Tanpa Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($dataAbsensi as $data) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data["no_absen"] ?></td>
                            <td><?= ucwords($data["nama"]) ?></td>
                            <td><?= $data["sakit"] ?></td>
                            <td><?= $data["izin"] ?></td>
                            <td><?= $data["tanpa_keterangan"] ?></td>
                        </tr>
                        <?php $no++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
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