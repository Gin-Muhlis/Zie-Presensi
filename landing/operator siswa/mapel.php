<?php
require "../../koneksi.php";
require "../../functions/login_function.php";

// cek user apakah sudah login atau belum
if (!isLoggedIn()) {
    Header("Location: ../../login.php");
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
    $dataUser = $_SESSION["user"];
}

// pdf viewer

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/mapel.css">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../js/build/pdf.js"></script>
    <title>halaman siswa</title>
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
                <a href="operator_siswa.php">Home</a>
            </div>
            <div class="menu">
                <a href="absensi.php">Absensi</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Jadwal Pelajaran</a>
            </div>
            <div class="menu">
                <a href="absensi/data_absensi.php">Data Absensi</a>
            </div>
            <div class="menu">
                <a href="agenda/agenda.php">Isi Agenda</a>
            </div>
        </div>
        <div class="footer-sidebar">
            <div class="menu-logout">
                <a href="../../logout.php?id=<?= $dataUser["id_operator"] ?>">Keluar</a>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="wrapper mapel">
            <h1>Jadwal Pelajaran</h1>


            <canvas id="canvas"></canvas>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.3.122/pdf.min.js"></script>
    <script src="pdfView.js"></script>
</body>

</html>