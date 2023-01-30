<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_agenda.php"; // !memanggil file functions.php

checkSession("login_operator siswa"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$dataAgenda = getDataAgenda($dataUser["kode"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/agenda.css">
    <title>halaman operator siswa</title>
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
                <a href="#">Home</a>
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
            <div class="menu" id="active">
                <a href="agenda.php">Agenda</a>
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
            <h1>Agenda Kelas <?= $dataUser["kode"] ?></h1>

            <div class="tambah-agenda">
                <a href="tambah_agenda.php?kodeKelas=<?= $dataUser["kode"] ?>">Tambah Agenda</a>
            </div>

            <table border="1" cellspacing="0">
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Guru</th>
                    <th>Jam</th>
                    <th>Materi</th>
                    <th>Keterangan</th>
                </thead>
                <tbody>
                    <?php if (count($dataAgenda) != 0) : ?>
                        <?php $no =  1; ?>
                        <?php foreach ($dataAgenda as $data) : ?>
                            <td><?= $no ?></td>
                            <td><?= $data["tanggal"] ?></td>
                            <td><?= $data["pengajar"] ?></td>
                            <td><?= $data["jam"] ?></td>
                            <td><?= $data["materi"] ?></td>
                            <td><?= $data["keterangan"] ?></td>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <td colspan="6">Agenda hari ini belum diisi</td>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>