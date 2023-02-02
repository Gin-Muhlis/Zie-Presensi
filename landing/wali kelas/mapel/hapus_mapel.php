<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

$id = $_GET["id"];

$conn->query("DELETE FROM jadwal WHERE id = $id");

header("Location: ../mapel.php");
