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
include("../../../data/pagination_user_admin.php");

$userData = getUser($conn, "SELECT * FROM user LIMIT $awalData,$jumlahDataPerHalaman");

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
                <a href="#">Data User</a>
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
            <h1>Data User</h1>
            <div class="tambah-data">
                <a href="tambah_user.php">Tambah User</a>
            </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if ($i == $halamanAktif) : ?>
                        <a href="?hal=<?= $i ?>" class="halamanAktif"><?= $i ?></a>
                    <?php else : ?>
                        <a href="?hal=<?= $i ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            <table border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Operator</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Hak Akses</th>
                        <th>Foto profile</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i <= count($userData); $i++) : ?>
                        <tr>
                            <td class="center"><?= $i + $awalData ?></td>
                            <td class="center"><?= $userData[$i - 1]["id_operator"] ?></td>
                            <td class="center"><?= $userData[$i - 1]["username"] ?></td>
                            <td class="center"><?= $userData[$i - 1]["role"] ?></td>
                            <td class="center"><?= $userData[$i - 1]["hak_akses"] ?></td>
                            <td class="center">
                                <img src="../../../image/<?= $userData[$i - 1]["foto"] ?>" alt="">
                            </td>
                            <td class="center aksi">
                                <a href="" class="edit">Edit</a>
                                <a href="" class="hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php endfor ?>
                </tbody>
            </table>
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


</body>

</html>