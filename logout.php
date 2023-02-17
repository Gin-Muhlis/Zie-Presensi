<?php
session_start(); // !Memulai session 
require "koneksi.php";

session_unset(); // !menghapus session
session_destroy(); // !menghapus session

$id = $_GET["id"];

setcookie("key", $id, time() - 3600);

$conn->query("DELETE FROM cookie WHERE user_id = '$id'");

header("Location: ./login.php"); // !untuk redirect ke halaman login