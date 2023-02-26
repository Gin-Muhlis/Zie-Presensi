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
    if ($dataKehadiran !== "tidak masuk") {
        $query = "INSERT INTO kehadiran_guru VALUES ('', '$dataKehadiran[id]', '$dataKehadiran[keterangan]', '$dataKehadiran[tgl]')";

        $conn->query($query);

        return mysqli_affected_rows($conn);
    } else {
        $current_date = date("Y-m-d");
        $query = "INSERT INTO kehadiran_guru VALUES ('', $idGuru, '$dataKehadiran', '$current_date')";

        $conn->query($query);

        return mysqli_affected_rows($conn);
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
