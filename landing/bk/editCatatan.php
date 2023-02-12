<?php
require "../../functions/functions.php"; // !memanggil file functions.php
require "../../functions/function_konsultasi.php"; // !memanggil file functions.php

checkSession("login_bk", "../../login.php"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$id = $_GET["id"];
$dataCatatan = getDataKonsultasi("SELECT * FROM konsultasi WHERE id = $id");
$dataNIS = getNIS();
$kelas = getKelas();
$jenisKonsul = array("karir", "belajar", "kasus");
$status = array("diproses", "selesai");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/konsultasi.css">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../js/jquery-3.6.3.min.js"></script>
    <script src="../../js/script-for-catatan.js"></script>
    <script src="../../js/upload.js"></script>
    <title>halaman wali kelas</title>
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
                <p><?= strtoupper($dataUser["level"]) ?></p>
            </div>
        </div>
        <div class="body-sidebar">
            <div class="menu">
                <a href="bk.php">Home</a>
            </div>
            <div class="menu">
                <a href="absensi.php">Absensi</a>
            </div>
            <div class="menu">
                <a href="konsultasi.php">Konsultasi Siswa</a>
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
            <h1>Edit Catatan</h1>
            <div class="edit-field">
                <a href="hapusCatatan.php?id=<?= $id ?>&gambar=<?= $dataCatatan[0]["dokumentasi"] ?>" class="editCatatan hapus" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')">Hapus Catatan</a>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" class="form-tambah">
                <input type="hidden" name="gambarLama" value="<?= $dataCatatan[0]["dokumentasi"] ?>">
                <label for="tanggal" class="disable">
                    <span>Tanggal Pembuatan Catatan</span>
                    <input type="text" name="tanggal" id="tanggal" autocomplete="off" value="<?= $dataCatatan[0]["tanggal"] ?>">
                </label>
                <label for="nis">
                    <span>NIS</span>
                    <select name="nis" id="nis">
                        <?php foreach ($dataNIS as $nis) : ?>
                            <option value="<?= $nis["nis"] ?>" <?php if ($nis["nis"] == $dataCatatan[0]["nis_siswa"]) {
                                                                    echo "selected";
                                                                } ?>><?= $nis["nis"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="nama">
                    <span>Nama</span>
                    <input type="text" name="nama" id="nama" autocomplete="off" value="<?= ucwords($dataCatatan[0]["nama_siswa"]) ?>">
                </label>
                <label for="kelas">
                    <span>Kelas</span>
                    <select name="kelas" id="kelas">
                        <?php foreach ($kelas as $kls) : ?>
                            <option value="<?= $kls["kode"] ?>" <?php if ($kls["kode"] == $dataCatatan[0]["kelas_siswa"]) {
                                                                    echo "selected";
                                                                } ?>><?= strtoupper($kls["kode"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="waliKelas">
                    <span>Wali Kelas</span>
                    <input type="text" name="waliKelas" id="waliKelas" autocomplete="off" value="<?= ucwords($dataCatatan[0]["waliKelas_siswa"]) ?>">
                </label>
                <label for="guruBk">
                    <span>Guru BK</span>
                    <input type="text" name="guruBk" id="guruBk" autocomplete="off" value="<?= ucwords($dataCatatan[0]["guruBK_siswa"]) ?>">
                </label>
                <label for="jenis">
                    <span>Jenis</span>
                    <select name="jenis" id="jenis">
                        <?php foreach ($jenisKonsul as $jenis) : ?>
                            <option value="<?= $jenis ?>" <?php if ($jenis == $dataCatatan[0]["jenisKonsultasi"]) {
                                                                echo "selected";
                                                            } ?>><?= ucwords($jenis) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="rangkuman">
                    <span>Rangkuman Konsultasi</span>
                    <textarea name="rangkuman" id="rangkuman"><?= ucfirst($dataCatatan[0]["rangkumanKonsultasi"]) ?></textarea>
                </label>
                <label for="penanganan">
                    <span>Penanganan</span>
                    <input type="text" name="penanganan" id="penanganan" autocomplete="off" value="<?= ucfirst($dataCatatan[0]["penanganan"]) ?>">
                </label>
                <label for="status">
                    <span>Status</span>
                    <select name="status" id="status">
                        <?php foreach ($status as $sts) : ?>
                            <option value="<?= $sts ?>" <?php if ($sts == $dataCatatan[0]["status"]) {
                                                            echo "selected";
                                                        } ?>><?= ucwords($sts) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="dokumentasi">
                    <span>Dokumentasi</span>
                    <?php if (strlen($dataCatatan[0]["dokumentasi"]) > 0) : ?>
                        <img src="../../image/<?= $dataCatatan[0]["dokumentasi"] ?>" alt="Dokumentasi Catatan">
                    <?php else : ?>
                        <p>Tidak ada dokumentasi</p>
                    <?php endif; ?>
                    <input type="file" name="dokumentasi" id="dokumentasi">
                </label>
                <div class="button-area">
                    <a class="batal" href="detailCatatan.php?id=<?= $id ?>">Batal</a>
                    <button name="editCatatan">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_FILES["image"])) {
        if (uploadImage($dataUser["nama"], "../../image/$dataUser[foto]", "../../image/") > 0) {
            echo "<script>
        alert ('Foto profile berhasil diedit!');
        document.location.href = './konsultasi.php';
        </script>";
        }
    }

    ?>

    <?php if (isset($_POST["editCatatan"])) {
        if (editCatatan($_POST, $id) > 0) {
            echo "<script>
        alert ('Catatan berhasil diedit!');
        document.location.href = './detailCatatan.php?id=$id';
        </script>";
        }
    } ?>

</body>

</html>