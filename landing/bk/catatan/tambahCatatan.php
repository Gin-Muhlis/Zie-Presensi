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

$dataNama = getDataForm($conn, "SELECT nama, id FROM siswa");
$dataWalas = getDataForm($conn, "SELECT guru.nama, wali_kelas.id_walas
              FROM user
              JOIN guru ON user.id = guru.id
              JOIN wali_kelas ON guru.id = wali_kelas.id_guru
              WHERE user.hak_akses = 'walas'");
$tahunAjaran = getDataForm($conn, "SELECT id, thn_ajaran, semester FROM tahun_ajaran")

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
    <!-- <div class="sidebar">
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
    </div> -->


    <div class="container">
        <div class="wrapper">
            <h1>Tambah Catatan</h1>

            <form action="" method="POST" enctype="multipart/form-data" class="form-tambah">
                <label for="tahunAjaran">
                    <span>Tahun Ajaran</span>
                    <select name="tahunAjaran" id="tahunAjaran">
                        <?php foreach ($tahunAjaran as $data) : ?>
                            <option value="<?= $data["id"] ?>">Semester <?= $data["semester"] ?> - <?= ucwords($data["thn_ajaran"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="nama">
                    <span>Nama</span>
                    <select name="nama" id="nama">
                        <?php foreach ($dataNama as $data) : ?>
                            <option value="<?= $data["id"] ?>"><?= ucwords($data["nama"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="waliKelas">
                    <span>Wali Kelas</span>
                    <select name="waliKelas" id="waliKelas">
                        <?php foreach ($dataWalas as $data) : ?>
                            <option value="<?= $data["id_walas"] ?>"><?= ucwords($data["nama"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="kasus">
                    <span>Kasus</span>
                    <textarea name="kasus" id="kasus"></textarea>
                </label>
                <label for="penanganan">
                    <span>Penanganan</span>
                    <input type="text" name="penanganan" id="penanganan" autocomplete="off">
                </label>
                <div class="dok">
                    <label for="dokumentasi">Dokumentasi</label>
                    <input type="file" name="dokumentasi" id="dokumentasi">
                </div>
                <label for="status">
                    <span>Status</span>
                    <select name="status" id="status">
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </label>
                <div class="button-area">
                    <button type="submit" name="tambahCatatan">Tambah</button>
                </div>
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

    <?php
    if (isset($_POST["tambahCatatan"])) {
        if (tambahCatatan($conn, $_POST) > 0) {
            echo "<script>
                    alert ('Catatan berhasil ditambahkan');
                    document.location.href = 'konsultasi.php';
                </script>";
        }
    }
    ?>

</body>

</html>