<?php
require "../../../koneksi.php";
require "../../../functions/login_function.php";
require "../../../functions/konsultasi_function.php";
require "../../../functions/upload_image_function.php";

// cek user apakah sudah login atau belum
if (!isLoggedIn()) {
    Header("Location: ../../../login.php");
    exit();
}

// cek user apakah memiliki role yang benar
if (!hasRole("bk")) {
    Header("Location: ../../errorLevel.php");
    exit();
}

include("../../../data/data_guru.php");

$id = $_GET["id"];

$query = "SELECT konsultasi.*, siswa.nama as nama_siswa, guru.nama as nama_guru, tahun_ajaran.thn_ajaran, tahun_ajaran.semester
            FROM guru
            JOIN wali_kelas ON guru.id = wali_kelas.id_guru
            JOIN konsultasi ON wali_kelas.id_walas = konsultasi.id_walas
            JOIN siswa ON siswa.id = konsultasi.id_siswa
            JOIN tahun_ajaran ON tahun_ajaran.id = konsultasi.id_th_ajaran
            WHERE konsultasi.id = $id";

$dataKonsul = getDataForm($conn, $query)[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/base.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/konsultasi.css">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../../js/jquery-3.6.3.min.js"></script>
    <script src="../../../js/upload.js"></script>
    <title>halaman wali kelas</title>
</head>

<body>
    <div class="sidebar">
        <div class="head-sidebar">
            <div class="image-profile">
                <img src="../../../image/<?= $dataUser["foto"] ?>" alt="image-profile">
                <div class="text-foto">
                    <span>Edit Foto</span>
                </div>
            </div>
            <div class="name-profile">
                <h2><?= $dataUser["username"] ?></h2>
            </div>
            <div class="class-profile">
                <p><?= ucwords($dataUser["role"]) ?></p>
            </div>
        </div>
        <div class="body-sidebar">
            <div class="menu">
                <a href="../bk.php">Home</a>
            </div>
            <div class="menu">
                <a href="../absensi.php">Absensi</a>
            </div>
            <div class="menu">
                <a href="konsultasi.php">Konsultasi Siswa</a>
            </div>
            <div class="menu">
                <a href="../editData/editData.php?id=<?= $dataUser["id"] ?>">Edit Data</a>
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
            <h1>Detail Catatan</h1>
            <div class="edit-field">
                <a href="editCatatan.php?id=<?= $id ?>" class="editCatatan">Edit Catatan</a>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" class="form-tambah">
                <label for="tanggal" class="disable">
                    <span>Tanggal Pembuatan Catatan</span>
                    <input type="text" name="tanggal" id="tanggal" autocomplete="off" value="<?= $dataKonsul["tanggal"] ?>">
                </label>
                <label for="tahunAjaran" class="disable">
                    <span>Tahun Ajaran</span>
                    <input type="text" name="tahunAjaran" id="nis" autocomplete="off" value="Semester <?= $dataKonsul["semester"] ?> - <?= $dataKonsul["thn_ajaran"] ?>">
                </label>
                <label for="nama" class="disable">
                    <span>Nama Siswa</span>
                    <input type="text" name="nama" id="nama" autocomplete="off" value="<?= ucwords($dataKonsul["nama_siswa"]) ?>">
                </label>
                <label for="waliKelas" class="disable">
                    <span>Wali Kelas</span>
                    <input type="text" name="waliKelas" id="waliKelas" autocomplete="off" value="<?= ucwords($dataKonsul["nama_guru"]) ?>">
                </label>
                <label for="rangkuman" class="disable">
                    <span>Kasus</span>
                    <input type="text" name="rangkuman" id="rangkuman" value="<?= ucfirst($dataKonsul["kasus"]) ?>">
                </label>
                <label for="penanganan" class="disable">
                    <span>Penanganan</span>
                    <input type="text" name="penanganan" id="penanganan" autocomplete="off" value="<?= ucfirst($dataKonsul["penanganan"]) ?>">
                </label>
                <label for="status" class="disable">
                    <span>Status</span>
                    <input type="text" name="status" id="status" autocomplete="off" value="<?= ucfirst($dataKonsul["status"]) ?>">
                </label>
                <label class="disable">

                    <span>Dokumentasi</span>
                    <?php if ($dataKonsul["dokumentasi"] == "-") : ?>
                        <p>Tidak ada dokumentasi</p>

                    <?php else : ?>
                        <img src="../../../image/<?= $dataKonsul["dokumentasi"] ?>" alt="">
                    <?php endif; ?>
                </label>
            </form>
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

    <?php if (isset($_FILES["image"])) {
        if (uploadImage($conn, $dataUser["id"], "../../../mage/", "../../../image/{$dataUser["foto"]}") > 0) {
            echo "<script>
        alert('Foto profile berhasil diganti!')
        document.location.href = '../bk.php'
      </script>";
        }
    } ?>

</body>

</html>