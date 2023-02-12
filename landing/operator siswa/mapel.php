<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_absensi.php"; // !memanggil file function_absensi.php
require "../../functions/functionMapel.php";

checkSession("login_operator siswa", "../../login.php"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
$hariIni = $nama_hari[date("w")];

$mataPelajaran = getDataMapel($dataUser["kode"], $hariIni);
$dataHari = getHari();
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
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.6.3.min.js"></script>
    <script src="../../js/upload.js"></script>
    <script src="../../js/script-for-mapel.js"></script>
    <title>halaman mata pelajaran</title>
</head>

<body>
    <div class="sidebar">
        <div class="head-sidebar">
            <div class="image-profile">
                <img <?php if (strlen($dataUser["foto"]) > 0) {
                            echo "src='../../image/$dataUser[foto]'";
                        } else {
                            echo "src='../../image/profile.jpg'";
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
                <a href="agenda/agenda.php">Agenda</a>
            </div>
        </div>
        <div class="footer-sidebar">
            <div class="menu-logout">
                <a href="../../logout.php?id=<?= $dataUser["id"] ?>">Keluar</a>
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
            <h1>Jadwal Pelajaran</h1>
            <form action="" method="POST">
                <div class="select-field">
                    <h2>Hari : </h2>
                    <select name="hari" id="hari">
                        <?php foreach ($dataHari as $hari) : ?>
                            <option value="<?= $hari["nama"] ?>" <?php if ($hari["nama"] == $hariIni) {
                                                                        echo "selected";
                                                                    } ?>><?= $hari["nama"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
            <div class="data-field" data-kelas="<?= $dataUser["kode"] ?>">
                <table border="1" cellspacing="0">
                    <thead>
                        <th>No</th>
                        <th>Jam</th>
                        <th>Mata Pelajaran</th>
                        <th>Pengajar</th>
                    </thead>
                    <?php if (date("w") == 0 || date("w") == 6) : ?>
                        <tbody>
                            <tr>
                                <td colspan="4">Tidak ada jadwal pelajaran hari ini</td>
                            </tr>
                        </tbody>

                    <?php else : ?>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($mataPelajaran as $mapel) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $mapel["jam_mulai"] ?> - <?= $mapel["jam_selesai"] ?></td>
                                    <td><?= $mapel["nama_mapel"] ?></td>
                                    <td><?= ucwords($mapel["nama_guru"]) ?></td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <?php
    if (isset($_FILES["image"])) {
        if (uploadImage($dataUser["nama"], "../../image/$dataUser[foto]", "../../image/") > 0) {
            echo "<script>
        alert ('Foto profile berhasil diedit!');
        document.location.href = './mapel.php';
        </script>";
        }
    }

    ?>

</body>

</html>