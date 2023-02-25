<?php
require "../../koneksi.php";
require "../../functions/login_function.php";
require "../../functions/walas_function.php";
require "../../functions/agenda_siswa_function.php";

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

$dataAgenda = getDataAgendaKelas($conn, $dataWalas["tingkat"], $dataWalas["rombel"], $dataWalas["bidang_keahlian"]);

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
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <title>halaman walas</title>
</head>

<body>
    <div class="sidebar">
        <div class="head-sidebar">
            <div class="image-profile">
                <img src="../../image/profile.jpg" alt="image-profile">
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
                <a href="wali_kelas.php">Home</a>
            </div>
            <div class="menu">
                <a href="absensi.php">Absensi</a>
            </div>
            <div class="menu">
                <a href="data_absensi.php">Absensi Kelas</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Agenda Kelas</a>
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
            <h1>Absensi <?= $dataWalas["tingkat"] ?> <?= $dataWalas["bidang_keahlian"] ?> <?= $dataWalas["rombel"] ?></h1>

            <table border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Mapel</th>
                        <th>Pemateri</th>
                        <th>Materi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($dataAgenda as $data) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data["tgl"] ?></td>
                            <td><?= ucwords($data["nama_mapel"]) ?></td>
                            <td><?= ucwords($data["nama"]) ?></td>
                            <td><?= ucwords($data["materi"]) ?></td>
                            <td><?= ucfirst($data["keterangan"]) ?></td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>