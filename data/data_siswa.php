<?php

$dataSession = $_SESSION["user"];
$userID = $dataSession["id_operator"];

if (isset($_COOKIE["key"])) {
    $dataCookie = getIdCookie($conn);

    $queryDataCookie = "SELECT user.username, user.role, user.id_operator, user.hak_akses, user.password, user.foto, siswa.*, kelas.tingkat, kelas.rombel, jurusan.bidang_keahlian, jurusan.kompetensi_keahlian
                FROM user
                JOIN siswa ON user.id = siswa.id
                JOIN siswa_kelas ON siswa.id = siswa_kelas.id_siswa
                JOIN kelas ON kelas.id = siswa_kelas.id_kelas
                JOIN jurusan ON kelas.id = jurusan.id
                WHERE user.id_operator = '$dataCookie[user_id]'";
}

$queryDataSession = "SELECT user.username, user.role, user.id_operator, user.hak_akses, user.password, user.foto, siswa.*, kelas.tingkat, kelas.rombel, jurusan.bidang_keahlian, jurusan.kompetensi_keahlian
                FROM user
                JOIN siswa ON user.id = siswa.id
                JOIN siswa_kelas ON siswa.id = siswa_kelas.id_siswa
                JOIN kelas ON kelas.id = siswa_kelas.id_kelas
                JOIN jurusan ON kelas.id = jurusan.id
                WHERE user.id_operator = '$userID'";

$dataUser = "";

if (isset($_COOKIE["key"])) {
    $dataUser = getDataFromCookie($conn, $queryDataCookie, $dataCookie);
} else {
    $dataUser = getDataFromSession($conn, $queryDataSession, $userID);
}
