<?php
require "../../../functions/functions.php"; // !memanggil file functions.php

checkSession("login_operator siswa"); // !menjalankan fungsi untuk mengecek session

$conn = mysqli_connect("localhost", "root", "", "school");

$id = $_GET["id"];
$conn->query("DELETE FROM agenda WHERE id = $id");

Header("Location: agenda.php");
