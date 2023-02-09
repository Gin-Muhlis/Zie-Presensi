<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_konsultasi.php"; // !memanggil file functions.php

checkSession("login_bk"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}


$dataNIS = getNIS();
$kelas = getKelas();

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
    <!-- <div class="sidebar">
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
            <div class="menu">
                <a href="konsultasi.php">Konsultasi Siswa</a>
            </div>
        </div>
        <div class="footer-sidebar">
            <div class="menu-logout">
                <a href="../../logout.php?id=<?= $dataUser["id"] ?>">Keluar</a>
            </div>
        </div>
    </div> -->

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
            <h1>Tambah Catatan</h1>

            <form action="" method="POST" enctype="multipart/form-data">
                <label for="nis">
                    <span>NIS</span>
                    <select name="nis" id="nis">
                        <?php foreach ($dataNIS as $nis) : ?>
                            <option value="<?= $nis["nis"] ?>"><?= $nis["nis"] ?></option>
                        <?php endforeach ?>
                    </select>
                </label>
                <label for="nama">
                    <span>Nama</span>
                    <input type="text" name="nama" id="nama">
                </label>
                <label for="kelas">
                    <span>Kelas</span>
                    <select name="kelas" id="kelas">
                        <?php foreach ($kelas as $kelas) : ?>
                            <option value="<?= $kelas["kode"] ?>"><?= strtoupper($kelas["kode"]) ?></option>
                        <?php endforeach ?>
                    </select>
                </label>
                <label for="waliKelas">
                    <span>Wali Kelas</span>
                    <input type="text" name="waliKelas" id="waliKelas">
                </label>
                <label for="guruBk">
                    <span>Guru BK</span>
                    <input type="text" name="guruBk" id="guruBk">
                </label>
                <label for="jenis">
                    <span>Jenis Konsutasi</span>
                    <select name="jenis" id="jenis">
                        <option value="Karir">Karir</option>
                        <option value="Belajar">Belajar</option>
                        <option value="Kasus">Kasus</option>
                    </select>
                </label>
                <label for="rangkuman">
                    <span>Rangkuman Konsultasi</span>
                    <textarea name="rangkuman" id="rangkuman" cols="30" rows="10"></textarea>
                </label>
                <label for="penanganan">
                    <span>Penanganan</span>
                    <input type="text" name="penanganan" id="penanganan">
                </label>
                <label for="dokumentasi">
                    <span>dokumentasi</span>
                    <input type="file" name="dokumentasi" id="dokumentasi">
                </label>
                <label for="status">
                    <span>Status</span>
                    <select name="status" id="status">
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </label>
                <div class="button-area">
                    <button type="submit" name="tambahCatatan">Tambah</button>
                </div>
            </form>
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

    <?php
    if (isset($_POST["tambahCatatan"])) {
        if (tambahCatatan($_POST) > 0) {
            echo "<script>
                    alert ('Catatan berhasil ditambahkan');
                    document.location.href = 'konsultasi.php';
                </script>";
        }
    }
    ?>

</body>

</html>