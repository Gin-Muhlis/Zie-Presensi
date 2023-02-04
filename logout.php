<?php
session_start(); // !Memulai session 

$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

session_unset(); // !menghapus session
session_destroy(); // !menghapus session

$id = $_GET["id"];

$conn->query("DELETE FROM cookie WHERE user_id = $id");

header("Location: ./login.php"); // !untuk redirect ke halaman login