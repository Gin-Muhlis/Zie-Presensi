<?php
require "../../../functions/functions.php"; // !memanggil file functions.php
require "../../../functions/function_absensi_guru.php"; // !memanggil file function_absensi.php
require "../../../functions/functionMapel.php";

checkSession("login_wali kelas"); // !menjalankan fungi untuk mengecek session

$dataUser = ""; // !membuat variabel untuk menyimpan data user

if (getDataFromCookie() !== false) { // !mengecek apakah function getDataFromCookie tidak sama dengan false
    $dataUser = getDataFromCookie(); // !menyimpan data yang dikembalikan ke dalam variabel dataUser
} else { // !ketika function getDataFromCookie mengembalikan false
    $dataUser = getDataFromSession();
}

$dataMapel = getFullMapel($dataUser["kelas"]);
$dataGuru = getDataGuru();
$dataHari = getHari();

$id = $_GET["id"];

$jadwal = findMapel($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../css/base.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/mapelGuru.css">
    <script src="https://kit.fontawesome.com/64f5e4ae10.js" crossorigin="anonymous"></script>
    <script src="../../../js/jquery-3.6.3.min.js"></script>
    <script src="../../../js/upload.js"></script>
    <title>halaman absensi</title>
</head>

<body>
    <div class="sidebar">
        <div class="head-sidebar">
            <div class="image-profile">
                <img <?php if (strlen($dataUser["foto"]) > 0) {
                            echo "src='../../../image/$dataUser[foto]'";
                        } else {
                            echo "src='../../../image/profile.jpg'";
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
                <a href="../wali_kelas.php">Home</a>
            </div>
            <div class="menu">
                <a href="../absensi.php">Absensi</a>
            </div>
            <div class="menu">
                <a href="../mapel.php">Mata Pelajaran</a>
            </div>
            <div class="menu">
                <a href="../absensi/data_absensi.php">Absensi Kelas</a>
            </div>
            <div class="menu">
                <a href="../agenda/data_agenda.php">Agenda Kelas</a>
            </div>
        </div>
        <div class="footer-sidebar">
            <div class="menu-logout">
                <a href="../../../logout.php?id=<?= $dataUser["id"] ?>">Keluar</a>
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
            <h1>Edit Mata Pelajaran <?= $dataUser["kelas"] ?></h1>
            <form action="" method="POST">
                <label for="mapel">
                    <span class="label">Mata Pelajaran</span>
                    <span class="two-point">:</span>
                    <select name="mapel" id="mapel">
                        <?php for ($i = 0; $i < count($dataMapel); $i++) : ?>
                            <option value="<?= $i + 1 ?>" <?php if ($dataMapel[$i]["nama"] == $jadwal[0]["nama_mapel"]) {
                                                                echo "selected";
                                                            } ?>><?= $dataMapel[$i]["nama"]; ?></option>
                        <?php endfor; ?>

                    </select>
                </label>
                <label for="guru">
                    <span class="label">Guru</span>
                    <span class="two-point">:</span>
                    <select name="guru" id="guru">
                        <?php for ($i = 0; $i < count($dataGuru); $i++) : ?>
                            <option value="<?= $i + 1 ?>" <?php if ($dataGuru[$i]["nama"] == $jadwal[0]["nama_guru"]) {
                                                                echo "selected";
                                                            } ?>><?= ucwords($dataGuru[$i]["nama"]); ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
                <label for="jam_mulai">
                    <span class="label">Jam Mulai</span>
                    <span class="two-point">:</span>
                    <input type="text" name="jam_mulai" id="jam_mulai" value="<?= $jadwal[0]["jam_mulai"] ?>">
                </label>
                <label for="jam_selesai">
                    <span class="label">Jam Selesai</span>
                    <span class="two-point">:</span>
                    <input type="text" name="jam_selesai" id="jam_selesai" value="<?= $jadwal[0]["jam_selesai"] ?>">
                </label>
                <label for="hari">
                    <span class="label">Hari</span>
                    <span class="two-point">:</span>
                    <select name="hari" id="hari">
                        <?php for ($i = 0; $i < count($dataHari); $i++) : ?>
                            <option value="<?= $i + 1 ?>" <?php if ($dataHari[$i]["nama"] == $jadwal[0]["nama_hari"]) {
                                                                echo "selected";
                                                            } ?>><?= ucwords($dataHari[$i]["nama"]); ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
                <div class="button-area">
                    <button type="submit" name="editMapel">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST["editMapel"])) {
        if (editMapel($id) > 0) {
            echo "hellowww";
            echo "<script>
                alert('Data berhasil diedit');
                document.location.href = '../mapel.php';
            </script>";
        }
    }
    ?>
    <?php
    if (isset($_FILES["image"])) {
        if (uploadImage($dataUser["nama"], "../../../image/$dataUser[foto]", "../../../image/") > 0) {
            echo "<script>
        alert ('Foto profile berhasil diedit!');
        document.location.href = '../mapel.php';
        </script>";
        }
    }

    ?>


</body>

</html>