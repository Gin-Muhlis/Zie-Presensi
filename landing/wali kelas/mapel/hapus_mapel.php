<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

checkSession("login_wali kelas", "../../../login.php"); // !menjalankan fungi untuk mengecek session

$id = $_GET["id"];

$conn->query("DELETE FROM jadwal WHERE id = $id");

header("Location: ../mapel.php");
