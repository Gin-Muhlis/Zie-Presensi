<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

function getDataAgenda($kodeKelas)
{
    global $conn;

    $today = date("Y-m-d");

    $agenda = [];

    $query = $conn->query("SELECT * FROM agenda WHERE kelas = '$kodeKelas' AND tanggal = '$today'");

    while ($row = $query->fetch_assoc()) {
        $agenda[] = $row;
    }

    return $agenda;
}

function tambahAgenda($kodeKelas)
{
    global $conn;

    $namaGuru = strtolower($_POST["nama_guru"]);
    $materi = strtolower($_POST["materi"]);
    $jam = $_POST["jam"];
    $keterangan = strtolower($_POST["keterangan"]);
    $current_date = date('Y-m-d');

    $query = "INSERT INTO agenda VALUES 
    ('', '$current_date', '$namaGuru', '$jam', '$materi', '$keterangan', '$kodeKelas')";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}
