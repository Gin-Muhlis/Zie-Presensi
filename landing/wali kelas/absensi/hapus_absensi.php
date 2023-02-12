<?php
$conn = mysqli_connect("localhost", "root", "", "school");

checkSession("login_wali kelas", "../../../login.php"); // !menjalankan fungi untuk mengecek session

$id = $_GET["id"];
$conn->query("DELETE FROM absensi WHERE id = $id");

Header("Location: data_absensi.php");
