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
    $status = strtolower($_POST["status"]);
    $keterangan = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["keterangan"]));
    $current_date = date("Y-m-d");

    if (strlen($keterangan) == 0) {
        $keterangan = "-";
    }

    $query = "INSERT INTO kehadiran VALUES('', $nama, '$status', '$keterangan', '$current_date')";

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

// ambil data absensi siswa
function getDataAbsensiSiswa($conn, $tingkat, $rombel, $kompetensiKeahlian)
{
    $query = "SELECT siswa.nama, siswa.no_absen,
            COUNT(CASE WHEN kehadiran.kehadiran = 'izin' THEN 1 END) AS izin,
            COUNT(CASE WHEN kehadiran.kehadiran = 'sakit' THEN 1 END) AS sakit,
            COUNT(CASE WHEN kehadiran.kehadiran = 'tanpa Keterangan' THEN 1 END) AS tanpa_keterangan
            FROM siswa
            JOIN kehadiran ON siswa.id = kehadiran.id_siswa
            JOIN siswa_kelas ON siswa.id = siswa_kelas.id_siswa
            JOIN kelas ON kelas.id = siswa_kelas.id_kelas
            JOIN jurusan ON jurusan.id = kelas.id_jurusan
            WHERE kelas.tingkat = $tingkat AND kelas.rombel = $rombel AND jurusan.kompetensi_keahlian = '$kompetensiKeahlian'
            GROUP BY siswa.nama
            
            ";

    $result = $conn->query($query);

    $allData = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $allData[] = $row;
    }

    return $allData;
}


// ambil data absensi siswa
function getFullAbsensiSiswa($conn, $query)
{

    $result = $conn->query($query);

    $allData = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $allData[] = $row;
    }

    return $allData;
}

// ambil data kelas
function getDataKelas($conn)
{

    $query = "SELECT kelas.tingkat, kelas.rombel, jurusan.kompetensi_keahlian FROM jurusan JOIN kelas ON jurusan.id = kelas.id_jurusan";

    $result = $conn->query($query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function cekSelected($value)
{
    if (isset($_POST["kelas"])) {
        if ($_POST["kelas"] === $value) {
            return "selected";
        }
    }
}
