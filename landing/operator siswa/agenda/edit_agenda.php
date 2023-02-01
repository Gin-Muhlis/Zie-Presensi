<?php
require "../../../functions/functions.php"; // !memanggil file functions.php
require "../../../functions/function_agenda.php"; // !memanggil file functions.php

checkSession("login_operator siswa"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$kodeKelas = $dataUser["kode"];

$id = $_GET["id"];

$today = date("Y-m-d");

$dataAgenda = getDataAgenda("SELECT * FROM agenda WHERE kelas = '$dataUser[kode]' AND tanggal = '$today' AND id = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/base.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/agenda.css">
    <title>halaman operator siswa</title>
</head>

<body>
    <div class="sidebar">
        <div class="head-sidebar">
            <div class="image-profile">
                <img src="../../../image/profile.jpg" alt="image-profile">
            </div>
            <div class="name-profile">
                <h2><?= ucwords($dataUser["nama"]) ?></h2>
            </div>
            <div class="class-profile">
                <p><?= ucwords($dataUser["level"]) ?></p>
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
                <a href="agenda.php">Agenda</a>
            </div>
        </div>
        <div class="footer-sidebar">
            <div class="menu-logout">
                <a href="../../../logout.php">Keluar</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="wrapper">
            <h1>Tambah Agenda Kelas <?= $dataUser["kode"] ?></h1>
            <form action="" method="POST">
                <label for="guru" class="field">
                    <span class="label">Nama Guru</span>
                    <span class="two-point">:</span>
                    <input type="text" name="nama_guru" id="guru" autocomplete="off" value="<?= $dataAgenda[0]["pengajar"] ?>">
                </label>
                <label for="materi" class="field">
                    <span class="label">Materi</span>
                    <span class="two-point">:</span>
                    <input type="text" name="materi" id="materi" autocomplete="off" value="<?= $dataAgenda[0]["materi"] ?>">
                </label>
                <label for="jam" class="field">
                    <span class="label">Jam</span>
                    <span class="two-point">:</span>
                    <input type="text" name="jam" id="jam" autocomplete="off" value="<?= $dataAgenda[0]["jam"] ?>">
                </label>
                <label for="keterangan">
                    <div class="keterangan-field">
                        <span class="label">Keterangan</span>
                        <span class="two-point">:</span>
                    </div>
                    <textarea name="keterangan" id="keterangan"><?= $dataAgenda[0]["keterangan"] ?></textarea>
                </label>
                <div class="button-area">
                    <button type="submit" name="edit-agenda">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST["edit-agenda"])) {
        if (editAgenda($id) > 0) {
            echo "<script>
                alert('Data berhasil diedit');
                document.location.href = 'agenda.php';
            </script>";
        }
    }
    ?>

</body>

</html>