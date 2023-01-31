<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

function getDataAgenda($query)
{
    global $conn;

    $agenda = [];

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $agenda[] = $row;
    }

    return $agenda;
}

function tambahAgenda($kodeKelas)
{
    global $conn;

    $namaGuru = mysqli_real_escape_string($conn, strtolower($_POST["nama_guru"]));
    $materi = mysqli_real_escape_string($conn, strtolower($_POST["materi"]));
    $jam = mysqli_real_escape_string($conn, strtolower($_POST["jam"]));
    $keterangan = mysqli_real_escape_string($conn, strtolower($_POST["keterangan"]));
    $current_date = date('Y-m-d');

    $query = "INSERT INTO agenda VALUES 
    ('', '$current_date', '$namaGuru', '$jam', '$materi', '$keterangan', '$kodeKelas')";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}

function editAgenda($id)
{
    global $conn;

    $namaGuru = mysqli_real_escape_string($conn, strtolower($_POST["nama_guru"]));
    $materi = mysqli_real_escape_string($conn, strtolower($_POST["materi"]));
    $jam = mysqli_real_escape_string($conn, strtolower($_POST["jam"]));
    $keterangan = mysqli_real_escape_string($conn, strtolower($_POST["keterangan"]));
    $query = "UPDATE agenda
              SET pengajar = '$namaGuru',
              materi = '$materi',
              jam = '$jam',
              keterangan = '$keterangan'
              WHERE id = $id";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}
