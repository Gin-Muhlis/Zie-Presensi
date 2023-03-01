<?php

// cek kehadiran guru
function ambilDataKehadiran($conn, $namaGuru)
{
    $current_date = date("Y-m-d");
    $query = "SELECT pembelajaran.*, guru.id
    FROM guru 
    JOIN pengampu ON guru.id = pengampu.id_guru 
    JOIN pembelajaran ON pengampu.id = pembelajaran.id_pengampu 
    WHERE guru.nama = '$namaGuru' AND tgl = '$current_date'";

    $result = $conn->query($query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        return $data;
    }
    return "tidak masuk";
}

function tambahKehadiran($conn, $dataKehadiran, $idGuru)
{
    $current_date = date("Y-m-d");
    $queryCek = "SELECT * FROM kehadiran_guru WHERE id_guru = $idGuru AND tanggal = '$current_date'";

    $resultCek = $conn->query($queryCek);

    if ($dataKehadiran !== "tidak masuk") {
        if (mysqli_num_rows($resultCek) <= 0) {
            $query = "INSERT INTO kehadiran_guru VALUES ('', '$dataKehadiran[id]', '$dataKehadiran[keterangan]', '$dataKehadiran[tgl]')";

            $conn->query($query);

            return mysqli_affected_rows($conn);
        } else {
            $dataTabel = mysqli_fetch_assoc($resultCek);

            $queryUpdate = "UPDATE kehadiran_guru SET kehadiran = '$dataKehadiran[keterangan]' WHERE id = $dataTabel[id]";

            $conn->query($queryUpdate);
            return mysqli_affected_rows($conn);
        }
    } else {
        if (mysqli_num_rows($resultCek) <= 0) {

            $query = "INSERT INTO kehadiran_guru VALUES ('', $idGuru, '$dataKehadiran', '$current_date')";

            $conn->query($query);

            return mysqli_affected_rows($conn);
        }
    }
}

function cekKehadiran($conn, $id)
{
    $current_date = date("Y-m-d");
    $query = "SELECT * FROM kehadiran_guru WHERE id_guru = $id AND tanggal = '$current_date' AND kehadiran = 'masuk'";

    $result = $conn->query($query);

    $data = false;

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    }

    return $data;
}

// ambil data absensi guru
function getFullAbsensiGuru($conn, $awalData, $jumlahDataPerHalaman)
{

    $query = "SELECT guru.nama, kehadiran_guru.*,
            COUNT(CASE WHEN kehadiran_guru.kehadiran = 'masuk' THEN 1 END) AS masuk,
            COUNT(CASE WHEN kehadiran_guru.kehadiran = 'tidak masuk' THEN 1 END) AS tidak_masuk
            FROM guru
            JOIN kehadiran_guru ON guru.id = kehadiran_guru.id_guru
            GROUP BY guru.nama LIMIT $awalData, $jumlahDataPerHalaman";

    $result = $conn->query($query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}
