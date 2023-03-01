<?php
require "../../../koneksi.php";
require "../../../functions/login_function.php";
require "../../../functions/edit-data-function.php";
require "../../../functions/upload_image_function.php";

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/base.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/editData.css">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../../js/jquery-3.6.3.min.js"></script>
    <script src="../../../js/upload.js"></script>
    <script src="../../../js/script-for-editData.js"></script>
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
            <div class="menu">
                <a href="../agenda/agenda.php">Isi Agenda</a>
            </div>
            <div class="menu" id="active">
                <a href="#">Edit Data</a>
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
            <h1>Edit Data</h1>
            <div class="form">
                <div class="form-head">
                    <div class="text">
                        <span class="active" id="profile">Edit Profile</span>
                    </div>
                    <div class="text">
                        <span id="dataDiri">Edit Data Pribadi</span>
                    </div>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" class="form-body">
                    <label for="username">
                        <span>Username</span>
                        <input type="text" name="username" id="username" value="<?= $dataUser["username"] ?>">
                    </label>
                    <label for="pwLama">
                        <span>Password Lama</span>
                        <input type="password" name="pwLama" id="pwLama">
                    </label>
                    <label for="pwBaru">
                        <span>Password Baru</span>
                        <input type="password" name="pwBaru" id="pwBaru">
                    </label>
                    <div class="button-area">
                        <button name="editProfile">Edit</button>
                    </div>
                </form>
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

    <?php if (isset($_FILES["image"])) {
        if (uploadImage($conn, $dataUser["id"], "../../../image/", "../../../image/{$dataUser["foto"]}") > 0) {
            echo "<script>
        alert('Foto profile berhasil diganti!')
        document.location.href = '../operator_siswa.php'
      </script>";
        }
    } ?>


    <?php if (isset($_POST["editProfile"])) {
        if (editProfile($conn, $_POST, $dataUser) > 0) {
            echo "<script>
                alert('Data berhasil diedit!');
                document.location.href = '../operator_siswa.php'
            </script>";
        }
    } ?>

    <?php if (isset($_POST["editDataDiri"])) {
        if (editPribadi($conn, $_POST, $dataUser) > 0) {
            echo "<script>
                alert('Data berhasil diedit!');
                document.location.href = '../operator_siswa.php'
            </script>";
        }
    } ?>

</body>

</html>