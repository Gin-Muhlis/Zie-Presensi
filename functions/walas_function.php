<?php

// ambil data walas
function getDataWalas($conn, $nama)
{

    $query = "SELECT guru.*, kelas.tingkat, kelas.rombel, jurusan.kompetensi_keahlian
              FROM guru
              JOIN wali_kelas ON guru.id = wali_kelas.id_guru
              JOIN kelas ON kelas.id = wali_kelas.id_kelas
              JOIN jurusan ON jurusan.id = kelas.id_jurusan
              WHERE guru.nama = '$nama'";

    $result = $conn->query($query);

    $data = mysqli_fetch_assoc($result);

    return $data;
}
