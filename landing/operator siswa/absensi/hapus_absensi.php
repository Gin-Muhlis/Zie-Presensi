<?php
require "../../../functions/functions.php"; // !memanggil file functions.php

checkSession("login_operator siswa", "../../../login.php"); // !menjalankan fungi untuk mengecek session

$conn = mysqli_connect("localhost", "root", "", "school");

$id = $_GET["id"];
$conn->query("DELETE FROM absensi WHERE id = $id");

Header("Location: data_absensi.php");
