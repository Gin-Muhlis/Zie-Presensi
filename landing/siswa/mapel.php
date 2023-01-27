<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_absensi.php"; // !memanggil file function_absensi.php
require "../../functions/functionMapel.php";

checkSession("login_siswa"); // !menjalankan fungsi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$mataPelajan = getDataMapel($dataUser["kode"]);

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
    <link rel="stylesheet" href="../../css/mapel.css">
    <title>halaman mata pelajaran</title>
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
                <a href="siswa.php">Home</a>
            </div>
            <div class="menu">
                <a href="absensi.php">Absensi</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Jadwal Pelajaran</a>
            </div>
            <div class="menu">
                <a href="#">Edit Data</a>
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
            <h1>Jadwal Pelajaran</h1>
            <form>
                <h2>Hari : <?= $mataPelajan[0]["nama_hari"] ?></h2>
                <select name="hari" id="hari">
                    <option value="senin">senin</option>
                    <option value="selasa">selasa</option>
                    <option value="rabu">rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="jumat">jumat</option>
                </select>
            </form>
            <table border="1" cellspacing="0">
                <thead>
                    <th>No</th>
                    <th>Jam</th>
                    <th>Mata Pelajaran</th>
                    <th>Pengajar</th>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($mataPelajan as $mapel) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $mapel["jam_mulai"] ?> - <?= $mapel["jam_selesai"] ?></td>
                            <td><?= $mapel["nama_mapel"] ?></td>
                            <td><?= ucwords($mapel["nama_guru"]) ?></td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const select = document.querySelector('select');

        select.onchange = function() {
            let pilihan = this.value;
            let formData = new FormData();
            formData.append("pilihan", pilihan);
            fetch("functionMapel.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.text)
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error(error);
                })
        }
    </script>

</body>

</html>