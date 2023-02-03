<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_data_absensi_guru.php"; // !memanggil file functions.php

checkSession("login_kepala sekolah"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$dataAbsensi = getDataAbsensiGuru("SELECT * FROM absensi_guru");

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
    <script src="../../js/script-for-absensi-guru.js"></script>
    <title>halaman kepala sekolah</title>
</head>

<body>
    <div class="sidebar">
        <div class="head-sidebar">
            <div class="image-profile">
                <img src="../../image/profile.jpg" alt="image-profile">
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
                <a href="kepala_sekolah.php">Home</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Absensi Guru</a>
            </div>
            <div class="menu">
                <a href="absensi_siswa.php">Absensi Siswa</a>
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
            <h1>Data Absensi Guru</h1>
            <form action="" method="POST">
                <input type="text" autocomplete="off" id="keyword" placeholder="Cari data">
            </form>
            <div class="data-field">
                <table border="1" cellspacing="0">
                    <thead>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($dataAbsensi as $data) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $data["nip"] ?></td>
                                <td><?= ucwords($data["nama"]) ?></td>
                                <td><?= $data["tanggal"] ?></td>
                                <td><?= ucwords($data["status"]) ?></td>
                                <td><?= ucfirst($data["keterangan"]) ?></td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>