<?php
require "../../../koneksi.php";
require "../../../functions/login_function.php";
require "../../../functions/konsultasi_function.php";

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
$id = $_GET["id"];
$gambar = $_GET["gambar"];

if (strlen($gambar) > 0) {
    unlink("../../../image/$gambar");
}

$conn->query("DELETE FROM konsultasi WHERE id = $id");

header("Location: konsultasi.php");
