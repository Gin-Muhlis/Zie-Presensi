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
$nama_siswa  = getDataForm($conn, "SELECT nama, id FROM siswa");
$dataWalas = getDataForm($conn, "SELECT guru.nama, wali_kelas.id_walas
              FROM user
              JOIN guru ON user.id = guru.id
              JOIN wali_kelas ON guru.id = wali_kelas.id_guru
              WHERE user.hak_akses = 'walas'");
$tahunAjaran = getDataForm($conn, "SELECT id, thn_ajaran, semester FROM tahun_ajaran");
$status = ["diproses", "selesai"]
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
                <a href="hapusCatatan.php?id=<?= $id ?>&gambar=<?= $dataKonsul["dokumentasi"] ?>" class="hapus" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')">Hapus Catatan</a>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" class="form-tambah">
                <input type="hidden" value="<?= $dataKonsul["dokumentasi"] ?>" name="gambarLama">
                <label for="tanggal" class="disable">
                    <span>Tanggal Pembuatan Catatan</span>
                    <input type="text" name="tanggal" id="tanggal" autocomplete="off" value="<?= $dataKonsul["tanggal"] ?>">
                </label>
                <label for="tahunAjaran">
                    <span>Tahun Ajaran</span>
                    <select name="tahunAjaran" id="tahunAjaran">
                        <?php foreach ($tahunAjaran as $tahun) : ?>
                            <option value="<?= $tahun["id"] ?>" <?php if ($tahun["thn_ajaran"] == $dataKonsul["thn_ajaran"]) {
                                                                    echo "selected";
                                                                } ?>>Semester <?= $tahun["semester"] ?> - <?= $tahun["thn_ajaran"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="nama">
                    <span>Nama Siswa</span>
                    <select name="nama" id="nama">
                        <?php foreach ($nama_siswa as $nama) : ?>
                            <option value="<?= $nama["id"] ?>" <?php if ($nama["nama"] == $dataKonsul["nama_siswa"]) {
                                                                    echo "selected";
                                                                } ?>><?= ucwords($nama["nama"]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="waliKelas">
                    <span>Wali Kelas</span>
                    <select name="waliKelas" id="waliKelas">
                        <?php foreach ($dataWalas as $walas) : ?>
                            <option value="<?= $walas["id_walas"] ?>" <?php if ($walas["nama"] == $dataKonsul["nama_guru"]) {
                                                                            echo "selected";
                                                                        } ?>><?= ucwords($walas["nama"]) ?></option>
                        <?php endforeach; ?>

                    </select>
                </label>
                <label for="kasus">
                    <span>Kasus</span>
                    <textarea name="kasus" id="kasus"><?= $dataKonsul["kasus"] ?></textarea>
                </label>
                <label for="penanganan">
                    <span>Penanganan</span>
                    <input type="text" name="penanganan" id="penanganan" autocomplete="off" value="<?= ucfirst($dataKonsul["penanganan"]) ?>">
                </label>
                <label for="status">
                    <span>Status</span>
                    <select name="status" id="status">
                        <?php foreach ($status as $sts) : ?>
                            <option value="<?= $sts ?>" <?php if ($sts == $dataKonsul["status"]) {
                                                            echo "selected";
                                                        } ?>><?= ucwords($sts) ?></option>
                        <?php endforeach; ?>

                    </select>
                </label>
                <label>
                    <span>Dokumentasi</span>
                    <?php if (strlen($dataKonsul["dokumentasi"]) > 0) : ?>
                        <img src="../../../image/<?= $dataKonsul["dokumentasi"] ?>" alt="">
                    <?php else : ?>
                        <p>Tidak ada dokumentasi</p>
                    <?php endif; ?>
                </label>
                <label for="dokumentasi">
                    <input type="file" name="dokumentasi" id="dokumentasi">
                </label>
                <div class="button-area">
                    <button class="batal"><a href="konsultasi.php">Batal</a></button>
                    <button name="editCatatan">Edit</button>
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
    if (isset($_POST["editCatatan"])) {
        if (editCatatan($conn, $_POST, $id) > 0) {
            echo "<script>
                    alert ('Catatan berhasil diedit');
                    document.location.href = 'konsultasi.php';
                </script>";
        }
    }
    ?>


</body>

</html>