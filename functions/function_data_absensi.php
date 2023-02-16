<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

function getDataAbsensi($getQuery)
{
    global $conn;

    $query = $conn->query($getQuery);

    $dataAbsensi = [];

    while ($row = $query->fetch_assoc()) {
        $dataAbsensi[] = $row;
    }

    return $dataAbsensi;
}


function editAbsensi($id)
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

    $query = "UPDATE absensi
             SET no_absen = $no_absen,
                 nama = '$nama',
                 kelas = '$kelas',
                 tanggal = '$current_date',
                 status = '$status',
                 keterangan = '$keterangan'
             WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
