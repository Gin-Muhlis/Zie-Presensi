<?php

// functino untuk menambah agenda
function tambahAgenda($conn, $post, $id_pengampu)
{
    // ambil data input
    $idSiswa = $id_pengampu;
    $idGuru = htmlspecialchars(mysqli_real_escape_string($conn, $post["guru"]));
    $materi = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["materi"])));
    $jmlMapel = htmlspecialchars(mysqli_real_escape_string($conn, $post["jumlahMapel"]));
    $jp = htmlspecialchars(mysqli_real_escape_string($conn, $post["jp"]));
    $keterangan = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["keterangan"])));
    $current_date = date("Y-m-d");

    if (strlen($keterangan) <= 0) {
        $keterangan = "-";
    }

    if (strlen($materi) <= 0) {
        $materi = "-";
    }

    $query = "INSERT INTO pembelajaran VALUES ('', $idSiswa, $idGuru, '$current_date', $jmlMapel, '$jp', '$materi', '$keterangan')";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}

// ambil data nama-nama guru
function getDataGuru($conn)
{
    $query = "SELECT pengampu.id, guru.nama FROM guru JOIN pengampu ON guru.id = pengampu.id_guru";

    $result = $conn->query($query);

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

// ambil data ageenda
function getAgenda($conn, $id_siswa)
{

    $current_date = date("Y-m-d");
    $query = "SELECT pembelajaran.*, mata_pelajaran.nama_mapel, guru.nama FROM guru 
    JOIN pengampu ON guru.id = pengampu.id_guru 
    JOIN mata_pelajaran ON mata_pelajaran.id = pengampu.id_mapel 
    JOIN pembelajaran ON pengampu.id = pembelajaran.id_pengampu
    JOIN siswa ON siswa.id = pembelajaran.id_siswa 
    WHERE id_siswa = $id_siswa AND pembelajaran.tgl = '$current_date';";

    $result = $conn->query($query);

    $data = [];

    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    return false;
}

// ambil semua data agenda berdasarkan kelas
function getDataAgendaKelas($conn, $tingkat, $rombel, $kompetensiKeahlian)
{

    $date = date("m-Y");

    $query = "SELECT pembelajaran.*, mata_pelajaran.nama_mapel, guru.nama FROM guru 
    JOIN pengampu ON guru.id = pengampu.id_guru 
    JOIN mata_pelajaran ON mata_pelajaran.id = pengampu.id_mapel 
    JOIN pembelajaran ON pengampu.id = pembelajaran.id_pengampu
    JOIN siswa ON siswa.id = pembelajaran.id_siswa 
    JOIN siswa_kelas ON siswa.id = siswa_kelas.id_siswa
    JOIN kelas ON kelas.id = siswa_kelas.id_kelas
    JOIN jurusan ON jurusan.id = kelas.id_jurusan
    WHERE kelas.tingkat = $tingkat AND kelas.rombel = $rombel AND jurusan.kompetensi_keahlian = '$kompetensiKeahlian' AND DATE_FORMAT(tgl, '%m-%Y') = '$date'";

    $result = $conn->query($query);

    $data = [];

    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    return false;
}
