<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_absensi_guru.php"; // !memanggil file function_absensi.php
require "../../functions/functionMapel.php";

checkSession("login_wali kelas"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$dataMapel = getAllMapel($dataUser["kelas"]);

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
            <div class="menu">
                <a href="absensi.php">Absensi</a>
            </div>
            <div class="menu" id="active">
                <a href="mapel.php">Mata Pelajaran</a>
            </div>
            <div class="menu">
                <a href="absensi/data_absensi.php">Absensi Kelas</a>
            </div>
            <div class="menu">
                <a href="agenda/agenda.php">Agenda Kelas</a>
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
            <h1>Mata Pelajaran <?= strtoupper($dataUser["kelas"]) ?></h1>
            <div class="tambah-area">
                <button>
                    <a href="tambah_mapel.php">Tambah Mapel</a>
                </button>
            </div>
            <table border="1" cellspacing="0">
                <thead>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Jam</th>
                    <th>Hari</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($dataMapel as $mapel) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $mapel["nama_mapel"] ?></td>
                            <td><?= ucwords($mapel["nama_guru"]) ?></td>
                            <td><?= $mapel["jam_mulai"] ?> <?= $mapel["jam_selesai"] ?></td>
                            <td><?= $mapel["nama_hari"] ?></td>
                            <td>
                                <a href="edit_mapel.php">Edit</a> | <a href="mapel/hapus_mapel.php?id=<?= $mapel["id"] ?>" onclick="return confirm('Apakah anda yakin?')">hapus</a>
                            </td>
                        </tr>
                        <?php $no++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



</body>

</html>