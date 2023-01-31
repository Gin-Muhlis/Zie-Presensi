<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

function tambahDataAbsensi()
{
    global $conn;

    $nama = mysqli_real_escape_string($conn, strtolower($_POST["nama"]));
    $kelas = mysqli_real_escape_string($conn, strtolower($_POST["kelas"]));
    $no_absen = mysqli_real_escape_string($conn, strtolower($_POST["no_absen"]));
    $status = mysqli_real_escape_string($conn, strtolower($_POST["status"]));
    $keterangan = mysqli_real_escape_string($conn, strtolower($_POST["keterangan"]));
    $current_date = date('Y-m-d');

    if (empty($keterangan)) {
        $keterangan = "-";
    }

    mysqli_query($conn, "INSERT INTO absensi VALUES ('', $no_absen, '$nama', '$kelas', '$current_date', '$status', '$keterangan')");

    return mysqli_affected_rows($conn);
}
