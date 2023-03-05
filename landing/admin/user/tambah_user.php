<?php
require "../../../koneksi.php";
require "../../../functions/login_function.php";
require "../../../functions/upload_image_function.php";
require "../../../functions/user_admin_function.php";

// cek user apakah sudah login atau belum
if (!isLoggedIn()) {
    Header("Location: ../../../login.php");
    exit();
}

// cek user apakah memiliki role yang benar
if (!hasRole("admin")) {
    Header("Location: ../../errorLevel.php");
    exit();
}

include("../../../data/data_admin.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/base.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/user_admin.css">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../../js/jquery-3.6.3.min.js"></script>
    <script src="../../../js/upload.js"></script>
    <title>halaman walas</title>
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
                <a href="../admin.php">Home</a>
            </div>
            <div class="menu">
                <a href="data_user.php">Data User</a>
            </div>
            <div class="menu">
                <a href="data_absensi.php">Absensi Kelas</a>
            </div>
            <div class="menu">
                <a href="data_agenda.php">Agenda Kelas</a>
            </div>
            <div class="menu">
                <a href="editData/editData.php">Edit Data</a>
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
            <h1>Tambah Data User</h1>
            <form action="" method="POST">
                <label for="id_operator">
                    <span>Id Operator</span>
                    <input type="text" name="id_operator" id="id_operator">
                </label>
                <label for="username">
                    <span>Username</span>
                    <input type="text" name="username" id="username">
                </label>
                <label for="password">
                    <span>Password</span>
                    <input type="text" name="password" id="password">
                </label>
                <label for="role">
                    <span>Role</span>
                    <select name="role" id="role">
                        <option value="siswa">Siswa</option>
                        <option value="guru">Guru</option>
                    </select>
                </label>
                <label for="hak_akses">
                    <span>Hak Akses</span>
                    <select name="hak_akses" id="hak_akses">
                        <option value="umum">Guru Umum</option>
                        <option value="walas">Guru Walas</option>
                        <option value="bk">Guru BK</option>
                        <option value="kepala sekolah">Kepala Sekolah</option>
                        <option value="siswa kelas">Siswa Kelas</option>
                        <option value="operator siswa">Operator Siswa</option>
                    </select>
                </label>
                <div class="button-area">
                    <button type="submit" name="tambah_user">Tambah</button>
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
        if (uploadImage($conn, $dataUser["id"], "../../../image/", "../../../image/{$dataUser["foto"]}") > 0) {
            echo "<script>
        alert('Foto profile berhasil diganti!')
        document.location.href = '../admin.php'
      </script>";
        }
    } ?>

    <?php if (isset($_POST["tambah_user"])) {
        if (tambahUser($conn, $_POST) > 0) {
            echo "<script>
        alert('Data berhasil ditambahkan!')
        document.location.href = 'data_user.php'
      </script>";
        }
    } ?>

</body>

</html>