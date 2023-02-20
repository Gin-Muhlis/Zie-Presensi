<?php

// ambil data nama siswa berdasarkan kelas
function getDataSiswa($conn, $bidangKeahlian, $tingkat)
{
    $query = "SELECT siswa.nama, siswa.id, siswa.no_absen
            FROM siswa
            JOIN siswa_kelas ON siswa.id = siswa_kelas.id_siswa
            JOIN kelas ON kelas.id = siswa_kelas.id_kelas
            JOIN jurusan ON jurusan.id =kelas.id_jurusan
            WHERE jurusan.bidang_keahlian = '$bidangKeahlian' AND kelas.tingkat = $tingkat";

    $result = $conn->query($query);

    $dataNama = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $dataNama[] = $row;
    }

    return $dataNama;
}

// simpan data absensi ke database
function tambahDataAbsensi($conn)
{

    // ambil data input
    $nama = $_POST["nama"];
    $no_absen = $_POST["no_absen"];
    $status = strtolower($_POST["status"]);
    $keterangan = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["keterangan"]));
    $current_date = date("Y-m-d");

    if (strlen($keterangan) == 0) {
        $keterangan = "-";
    }

    $query = "INSERT INTO kehadiran VALUES('', $no_absen, $nama, '$status', '$keterangan', '$current_date')";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}

// cek apakah hadir atau tidak hari ini
function cekKehadiran($conn, $id_siswa)
{

    $current_date = date("Y-m-d");
    $query = "SELECT kehadiran.* FROM kehadiran
            JOIN siswa ON siswa.id = kehadiran.id_siswa
            WHERE kehadiran.id_siswa = $id_siswa AND tanggal = '$current_date'";

    $result = $conn->query($query);
    $data = false;

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    }

    return $data;
}
