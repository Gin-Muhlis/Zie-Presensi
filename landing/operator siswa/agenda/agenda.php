<?php
require "../../../koneksi.php";
require "../../../functions/login_function.php";
require "../../../functions/agenda_siswa_function.php";

// cek user apakah sudah login atau belum
if (!isLoggedIn()) {
    Header("Location: ../../../login.php");
    exit();
}

// cek user apakah memiliki role yang benar
if (!hasRole("operator siswa")) {
    Header("Location: ../../errorLevel.php");
    exit();
}
include("../../../data/data_siswa.php");

$dataAgenda = getAgenda($conn, $dataUser["id"])
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
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <title>halaman siswa</title>
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
                <a href="../absensi/data_absensi.php">Isi Absensi</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Isi Agenda</a>
            </div>
            <div class="menu">
                <a href="../editData/editData.php">Edit Data</a>
            </div>
        </div>
        <div class="footer-sidebar">
            <div class="menu-logout">
                <a href="../../../logout.php?id=<?= $dataUser["id_operator"] ?>">Keluar</a>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="wrapper">
            <h1>Agenda <?= $dataUser["tingkat"] ?> <?= $dataUser["bidang_keahlian"] ?> <?= $dataUser["rombel"] ?></h1>
            <div class="button-area">
                <a href="tambah_agenda.php">Tambah Agenda</a>
            </div>
            <table border="1" cellspacing="0">
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Mapel</th>
                    <th>Pemtari</th>
                    <th>Materi/Tugas</th>
                    <th>Keterangan</th>
                </thead>
                <tbody>
                    <?php if ($dataAgenda !== false) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($dataAgenda as $data) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $data["tgl"] ?></td>
                                <td><?= $data["jp"] ?></td>
                                <td><?= ucwords($data["nama_mapel"]) ?></td>
                                <td><?= ucwords($data["nama"]) ?></td>
                                <td><?= ucfirst($data["materi"]) ?></td>
                                <td><?= ucfirst($data["keterangan"]) ?></td>

                            </tr>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <tr>
                            <td colspan="7">Agenda hari ini belum diisi</td>

                        </tr>
                    <?php endif;; ?>

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>