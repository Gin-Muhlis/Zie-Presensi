<?php
$conn = mysqli_connect("localhost", "root", "", "school");

$id = $_GET["id"];
$conn->query("DELETE FROM absensi WHERE id = $id");

Header("Location: data_absensi.php");
