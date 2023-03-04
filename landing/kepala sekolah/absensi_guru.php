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
if (!hasRole("kepala sekolah")) {
    Header("Location: ../errorLevel.php");
    exit();
}

include("../../data/data_guru.php");
include("../../data/pagination.php");


$dataAbsensi = getFullAbsensiGuru($conn, $awalData, $jumlahDataPerHalaman);

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
    <title>halaman wali kelas</title>
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
                <a href="kepala_sekolah.php">Home</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Absensi GUru</a>
            </div>
            <div class="menu">
                <a href="absensi_siswa.php">Absensi Siswa</a>
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
            <h1 class="data-absensi">Absensi Guru</h1>
            <div class="pagination">
                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if ($i == $halamanAktif) : ?>
                        <a href="?hal=<?= $i ?>" class="halamanAktif"><?= $i ?></a>
                    <?php else : ?>
                        <a href="?hal=<?= $i ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            <div class="data-field">
                <table border="1" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama Lengkap</th>
                            <th colspan="2">Kehadiran</th>
                        </tr>
                        <tr>
                            <th>Masuk</th>
                            <th>Tidak Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 1; $i <= count($dataAbsensi); $i++) : ?>
                            <tr>
                                <td><?= $i + $awalData ?></td>
                                <td class="nama-kolom"><?= ucwords($dataAbsensi[$i - 1]["nama"]) ?></td>
                                <td><?= $dataAbsensi[$i - 1]["masuk"] ?></td>
                                <td><?= $dataAbsensi[$i - 1]["tidak_masuk"] ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>

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
        document.location.href = 'kepala_sekolah.php'
      </script>";
        }
    } ?>
</body>

</html>