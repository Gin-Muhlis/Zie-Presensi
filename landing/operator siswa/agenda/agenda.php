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

$today = date("Y-m-d");

$dataAgenda = getDataAgenda("SELECT * FROM agenda WHERE kelas = '$dataUser[kode]' AND tanggal = '$today'");

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
    <script src="../../../js/jquery-3.6.3.min.js"></script>
    <script src="../../../js/upload.js"></script>
    <title>halaman operator siswa</title>
</head>

<body>
    <div class="sidebar">
        <div class="head-sidebar">
            <div class="image-profile">
                <img <?php if (strlen($dataUser["foto"]) > 0) {
                            echo "src='../../../image/$dataUser[foto]'";
                        } else {
                            echo "src='../../../image/profile.jpg'";
                        } ?> alt="image-profile">
                <div class="text-foto">
                    <span>Edit Foto</span>
                </div>
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
                <a href="../absensi/data_absensi.php">Data Absensi</a>
            </div>
            <div class="menu" id="active">
                <a href="agenda.php">Agenda</a>
            </div>
        </div>
        <div class="footer-sidebar">
            <div class="menu-logout">
                <a href="../../../logout.php?id=<?= $dataUser["id"] ?>">Keluar</a>
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
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php if (count($dataAgenda) != 0) : ?>
                        <?php $no =  1; ?>
                        <?php foreach ($dataAgenda as $data) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $data["tanggal"] ?></td>
                                <td><?= ucwords($data["pengajar"]) ?></td>
                                <td><?= ucwords($data["jam"]) ?></td>
                                <td><?= ucwords($data["materi"]) ?></td>
                                <td><?= ucfirst($data["keterangan"]) ?></td>
                                <td>
                                    <a href="edit_agenda.php?id=<?= $data["id"] ?>">Edit</a> | <a href="hapus_agenda.php?id=<?= $data["id"] ?>" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <td colspan="7">Agenda hari ini belum diisi</td>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    if (isset($_FILES["image"])) {
        if (uploadImage($dataUser["nama"], "../../../image/$dataUser[foto]", "../../../image/") > 0) {
            echo "<script>
        alert ('Foto profile berhasil diedit!');
        document.location.href = './agenda.php';
        </script>";
        }
    }

    ?>

</body>

</html>