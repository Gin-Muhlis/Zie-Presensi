<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

function getDataMapel($kodeKelas, $hari)
{
    global $conn;

    $query = "SELECT hari.nama as nama_hari, jadwal.jam_mulai, jadwal.jam_selesai, mapel.nama as nama_mapel, guru.nama as nama_guru 
    FROM jadwal 
    JOIN hari ON jadwal.id_hari = hari.id 
    JOIN mapel ON jadwal.id_mapel = mapel.id 
    JOIN guru ON jadwal.id_guru = guru.id 
    JOIN kelas ON jadwal.id_kelas = kelas.id 
    WHERE hari.nama = '$hari' AND kelas.kode = '$kodeKelas'";

    $result = mysqli_query($conn, $query);

    $mapel = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $mapel[] = $row;
    }

    return $mapel;
}

function getAllMapel($kodeKelas)
{
    global $conn;

    $query = "SELECT jadwal.id, hari.nama as nama_hari, jadwal.jam_mulai, jadwal.jam_selesai, mapel.nama as nama_mapel, guru.nama as nama_guru 
    FROM jadwal 
    JOIN hari ON jadwal.id_hari = hari.id 
    JOIN mapel ON jadwal.id_mapel = mapel.id 
    JOIN guru ON jadwal.id_guru = guru.id 
    JOIN kelas ON jadwal.id_kelas = kelas.id 
    WHERE kelas.kode = '$kodeKelas'";

    $result = mysqli_query($conn, $query);

    $mapel = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $mapel[] = $row;
    }

    return $mapel;
}
