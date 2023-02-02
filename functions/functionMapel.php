<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database
$allClass = array("11 rpl 1", "11 rpl 2");

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

function findMapel($id)
{
    global $conn;

    $query = "SELECT jadwal.id, hari.nama as nama_hari, jadwal.jam_mulai, jadwal.jam_selesai, mapel.nama as nama_mapel, guru.nama as nama_guru 
    FROM jadwal 
    JOIN hari ON jadwal.id_hari = hari.id 
    JOIN mapel ON jadwal.id_mapel = mapel.id 
    JOIN guru ON jadwal.id_guru = guru.id 
    JOIN kelas ON jadwal.id_kelas = kelas.id 
    WHERE jadwal.id = '$id'";

    $result = mysqli_query($conn, $query);

    $mapel = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $mapel[] = $row;
    }

    return $mapel;
}

function getFullMapel()
{
    global $conn;

    $query = "SELECT * FROM mapel";

    $result = mysqli_query($conn, $query);

    $mapel = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $mapel[] = $row;
    }

    return $mapel;
}

function editMapel($id)
{
    global $conn;

    $mapel = mysqli_real_escape_string($conn, $_POST["mapel"]);
    $guru = mysqli_real_escape_string($conn, strtolower($_POST["guru"]));
    $jam_mulai = mysqli_real_escape_string($conn, $_POST["jam_mulai"]);
    $jam_selesai = mysqli_real_escape_string($conn, $_POST["jam_selesai"]);
    $hari = mysqli_real_escape_string($conn, $_POST["hari"]);

    $query = "UPDATE jadwal
             SET jam_mulai = '$jam_mulai',
                 jam_selesai = '$jam_selesai',
                 id_guru = $guru,
                 id_mapel = $mapel,
                 id_hari = $hari
             WHERE id = $id";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}

function tambahMapel($kelas)
{
    global $conn;
    global $allClass;

    var_dump($allClass);
    $mapel = mysqli_real_escape_string($conn, $_POST["mapel"]);
    $guru = mysqli_real_escape_string($conn, strtolower($_POST["guru"]));
    $jam_mulai = mysqli_real_escape_string($conn, $_POST["jam_mulai"]);
    $jam_selesai = mysqli_real_escape_string($conn, $_POST["jam_selesai"]);
    $hari = mysqli_real_escape_string($conn, $_POST["hari"]);
    $id_kelas = array_search($kelas, $allClass)  +  1;

    $query = "INSERT INTO jadwal VALUES('', '$jam_mulai', '$jam_selesai', $id_kelas, $guru, $mapel, $hari)";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}
