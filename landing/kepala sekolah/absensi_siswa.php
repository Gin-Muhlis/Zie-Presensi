<?php
require "../../koneksi.php";
require "../../functions/login_function.php";
require "../../functions/absensi_siswa_function.php";

// cek user apakah sudah login atau belum
if (!isLoggedIn()) {
    Header("Location: ../../login.php");
    exit();
}

// cek user apakah memiliki role yang benar
if (!hasRole("kepala sekolah")) {
    Header("Location: ../errorLevel.php");
    exit();
}

include("../../data/data_guru.php");

$dataAbsensi = getFullAbsensiSiswa($conn, "SELECT siswa.nama, siswa.no_absen,
            COUNT(CASE WHEN kehadiran.kehadiran = 'izin' THEN 1 END) AS izin,
            COUNT(CASE WHEN kehadiran.kehadiran = 'sakit' THEN 1 END) AS sakit,
            COUNT(CASE WHEN kehadiran.kehadiran = 'tanpa Keterangan' THEN 1 END) AS tanpa_keterangan
            FROM siswa
            JOIN kehadiran ON siswa.id = kehadiran.id_siswa
            JOIN siswa_kelas ON siswa.id = siswa_kelas.id_siswa
            JOIN kelas ON kelas.id = siswa_kelas.id_kelas
            JOIN jurusan ON jurusan.id = kelas.id_jurusan
             WHERE kelas.tingkat = 11 AND kelas.rombel = 1 AND jurusan.bidang_keahlian = 'rekayasa perangkat lunak'
            GROUP BY siswa.nama
            ");

$dataKelas = getDataKelas($conn);

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
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.6.3.min.js"></script>
    <script src="../../js/script-for-absensi-siswa.js"></script>
    <title>halaman wali kelas</title>
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
                <a href="kepala_sekolah.php">Home</a>
            </div>
            <div class="menu">
                <a href="absensi_guru.php">Absensi GUru</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Absensi Siswa</a>
            </div>
            <div class="menu">
                <a href="editData/editData.php">Edit Data</a>
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
            <h1 class="data-absensi">Absensi Siswa</h1>

            <div class="filter-field">
                <h3>Filter Data : </h3>
                <select name="kelas" id="kelas">
                    <?php foreach ($dataKelas as $kelas) : ?>
                        <option value="<?= $kelas["tingkat"] ?> <?= $kelas["bidang_keahlian"] ?> <?= $kelas["rombel"] ?>"><?= $kelas["tingkat"] ?> <?= ucwords($kelas["bidang_keahlian"]) ?> <?= $kelas["rombel"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="data-field">
                <table border="1" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">No Absen</th>
                            <th rowspan="2">Nama Lengkap</th>
                            <th colspan="3">Kehadiran</th>
                        </tr>
                        <tr>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Tanpa Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($dataAbsensi as $data) : ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $data["no_absen"] ?></td>
                                <td><?= ucwords($data["nama"]) ?></td>
                                <td><?= $data["sakit"] ?></td>
                                <td><?= $data["izin"] ?></td>
                                <td><?= $data["tanpa_keterangan"] ?></td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


</body>

</html>