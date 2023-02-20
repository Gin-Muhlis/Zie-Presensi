<?php
require "../../../koneksi.php";
require "../../../functions/login_function.php";
require "../../../functions/absensi_siswa_function.php";

// cek user apakah sudah login atau belum
if (!isLoggedIn()) {
    Header("Location: ../../../login.php");
    exit();
}

// cek user apakah memiliki role yang benar
if (!hasRole("operator siswa")) {
    Header("Location: ../errorLevel.php");
    exit();
}

$dataUser = "";

if (isset($_COOKIE["key"])) {
    $dataUser = getDataFromCookie($conn);
} else {
    $dataUser = getDataFromSession($conn);
}

$dataSiswa = getDataSiswa($conn, $dataUser["bidang_keahlian"], $dataUser["tingkat"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../css/base.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/editAbsensi.css">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../../js/jquery-3.6.3.min.js"></script>
    <script src="../../../js/upload.js"></script>
    <title>halaman absensi</title>
</head>

<body>
    <div class="sidebar">
        <div class="head-sidebar">
            <div class="image-profile">
                <img src="../../../image/profile.jpg" alt="image-profile">
                <div class="text-foto">
                    <span>Edit Foto</span>
                </div>
            </div>
            <div class="name-profile">
                <h2><?= ucwords($dataUser["username"]) ?></h2>
            </div>
            <div class="class-profile">
                <p><?= ucwords($dataUser["role"]) ?></p>
            </div>
        </div>
        <div class="body-sidebar">
            <div class="menu">
                <a href="../operator_siswa.php">Home</a>
            </div>
            <div class="menu">
                <a href="../absensi.php">Absensi</a>
            </div>
            <div class="menu">
                <a href="../mapel.php">Jadwal Pelajaran</a>
            </div>
            <div class="menu">
                <a href="data_absensi.php">Data Absensi</a>
            </div>
            <div class="menu">
                <a href="../agenda/agenda.php">Isi Agenda</a>
            </div>
        </div>
        <div class="footer-sidebar">
            <div class="menu-logout">
                <a href="../../../logout.php?id=<?= $dataUser["id_operator"] ?>">Keluar</a>
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
            <h1>Siswa Yang Tidak Hadir</h1>
            <form action="#" method="POST">
                <label class="field">
                    <span class="label">Nama</span>
                    <select name="nama" id="nama">
                        <?php foreach ($dataSiswa as $siswa) : ?>
                            <option value="<?= $siswa["id"] ?>"><?= ucwords($siswa["nama"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label class="field">
                    <span class="label">No Absen</span>
                    <select name="no_absen" id="no_absen">
                        <?php foreach ($dataSiswa as $siswa) : ?>
                            <option value="<?= $siswa["no_absen"] ?>"><?= $siswa["no_absen"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <div id="status">
                    <span class="status-field label">Status</span>
                    <div class="jenis-status">
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
                    </div>
                    <textarea name="keterangan" id="keterangan"></textarea>
                </label>
                <div class="button-area">
                    <button type="submit" name="tambah-absensi">Tambah</button>
                </div>
            </form>

        </div>
    </div>

    <?php

    if (isset($_POST["tambah-absensi"])) {
        if (tambahDataAbsensi($conn) > 0) {
            echo "<script>
                alert('Data absensi berhasil ditambahkan');
                document.location.href = './data_absensi.php';
            </script>";
        }
    }

    ?>

</body>

</html>