<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

function tambahCatatan($post)
{
    global $conn;

    $nis = htmlspecialchars(mysqli_real_escape_string($conn, $post["nis"]));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["nama"])));
    $kelas = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["kelas"])));
    $waliKelas = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["waliKelas"])));
    $guruBK = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["guruBk"])));
    $jenis = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["jenis"])));
    $rangkuman = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["rangkuman"])));
    $penanganan = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["penanganan"])));
    $dokumentasi = $_FILES["dokumentasi"]["name"];
    $status = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["status"])));
    $current_date = date('Y-m-d');

    $query = "INSERT INTO konsultasi VALUES ('', $nis, '$nama', '$kelas', '$waliKelas', '$guruBK', '$jenis', '$rangkuman', '$penanganan', '$status', '$dokumentasi', '$current_date')";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}
