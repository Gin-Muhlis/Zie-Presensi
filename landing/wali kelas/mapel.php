<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_absensi_guru.php"; // !memanggil file function_absensi.php

checkSession("login_wali kelas"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/mapelGuru.css">
    <title>halaman absensi</title>
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
                <a href="wali_kelas.php">Home</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Absensi</a>
            </div>
            <div class="menu">
                <a href="mapel.php">Jadwal Pelajaran</a>
            </div>
            <div class="menu">
                <a href="absensi/data_absensi.php">Data Absensi</a>
            </div>
            <div class="menu">
                <a href="agenda/agenda.php">Agenda</a>
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
            <h1>Jadwal Pelajaran <?= strtoupper($dataUser["kelas"]) ?></h1>
            <div class="tambah-area">
                <button>
                    <a href="tambah_mapel.php">Tambah Mapel</a>
                </button>
            </div>
            <table border="1" cellspacing="0">
                <thead>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mapel</th>
                    <th>Guru</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">Senin</td>
                        <td>07.00 - 09.00</td>
                        <td>Matematika</td>
                        <td>Novi Siswayanti</td>
                        <td>
                            <a href="edit_mapel.php">Edit</a> | <a href="hapus_mapel.php">hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td>09.00 - 11.00</td>
                        <td>Bahasa Indonesia</td>
                        <td>Tedi hadiansyah</td>
                        <td>
                            <a href="edit_mapel.php">Edit</a> | <a href="hapus_mapel.php">hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2">Senin</td>
                        <td>07.00 - 09.00</td>
                        <td>Matematika</td>
                        <td>Novi Siswayanti</td>
                        <td>
                            <a href="edit_mapel.php">Edit</a> | <a href="hapus_mapel.php">hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td>09.00 - 11.00</td>
                        <td>Bahasa Indonesia</td>
                        <td>Tedi hadiansyah</td>
                        <td>
                            <a href="edit_mapel.php">Edit</a> | <a href="hapus_mapel.php">hapus</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>



</body>

</html>