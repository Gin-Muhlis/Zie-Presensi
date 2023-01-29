<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_data_absensi.php"; // !memanggil file functions_data_absensi.php

checkSession("login_operator siswa"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$id = strtolower($_GET["id"]);

$dataAbsensi = getDataAbsensi("SELECT * FROM absensi WHERE id = $id");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/styleAbsensi.css">
    <link rel="stylesheet" href="../../css/editAbsensi.css">
    <title>Halaman edit data absensi</title>
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
                <a href="operator_siswa.php">Home</a>
            </div>
            <div class="menu">
                <a href="absensi.php">Absensi</a>
            </div>
            <div class="menu">
                <a href="mapel.php">Jadwal Pelajaran</a>
            </div>
            <div class="menu">
                <a href="data_absensi.php">Data Absensi</a>
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
            <h1>Edit Absensi Siswa</h1>
            <form action="#" method="POST">
                <label class="field">
                    <span class="label">Nama</span>
                    <span class="two-point">:</span>
                    <input type="text" name="nama" id="nama" autocomplete="off" value="<?= ucwords($dataAbsensi[0]["nama"]) ?>">
                </label>
                <label class="field">
                    <span class="label">Kelas</span>
                    <span class="two-point">:</span>
                    <input type="text" name="kelas" id="kelas" autocomplete="off" value="<?= strtoupper($dataAbsensi[0]["kelas"]) ?>">
                </label>
                <label class="field">
                    <span class="label">No Absen</span>
                    <span class="two-point">:</span>
                    <input type="text" name="no_absen" id="no_absen" autocomplete="off" value="<?= $dataAbsensi[0]["no_absen"] ?>">
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
                        <label for="tanpaKeterangan">
                            <span class="label">Tanpa Keterangan</span>
                            <input type="radio" name="status" id="tanpaKeterangan" value="tanpa keterangan" required>
                        </label>
                    </div>
                </div>
                <label for="keterangan">
                    <div class="field keterangan-field">
                        <span class="label">keterangan</span>
                        <span class="two-point">:</span>
                    </div>
                    <textarea name="keterangan" id="keterangan"><?= $dataAbsensi[0]["keterangan"] ?></textarea>
                </label>
                <div class="button-area">
                    <button type="submit" name="edit-absensi">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST["edit-absensi"])) {
        if (editAbsensi($id) > 0) {
            echo "hellowww";
            echo "<script>
                alert('Data berhasil diedit');
                document.location.href = 'data_absensi.php';
            </script>";
        }
    }
    ?>
</body>

</html>