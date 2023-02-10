<?php
require "../../functions/functions.php"; // !memanggil file functions.php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

checkSession("login_bk"); // !menjalankan fungi untuk mengecek session

$id = $_GET["id"];
$gambar = $_GET["gambar"];

if (strlen($gambar) > 0) {
    unlink("../../image/$gambar");
}

$conn->query("DELETE FROM konsultasi WHERE id = $id");

header("Location: konsultasi.php");
