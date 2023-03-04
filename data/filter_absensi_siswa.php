<?php
require "../koneksi.php";
require "../functions/absensi_siswa_function.php";

$tingkat = $_GET["tingkat"];
$bidang = $_GET["bidang"];
$rombel = $_GET["rombel"];


$dataAbsensi = getFullAbsensiSiswa($conn, "SELECT siswa.nama, siswa.no_absen,
            COUNT(CASE WHEN kehadiran.kehadiran = 'izin' THEN 1 END) AS izin,
            COUNT(CASE WHEN kehadiran.kehadiran = 'sakit' THEN 1 END) AS sakit,
            COUNT(CASE WHEN kehadiran.kehadiran = 'tanpa Keterangan' THEN 1 END) AS tanpa_keterangan
            FROM siswa
            JOIN kehadiran ON siswa.id = kehadiran.id_siswa
            JOIN siswa_kelas ON siswa.id = siswa_kelas.id_siswa
            JOIN kelas ON kelas.id = siswa_kelas.id_kelas
            JOIN jurusan ON jurusan.id = kelas.id_jurusan
            WHERE kelas.tingkat = $tingkat AND jurusan.kompetensi_keahlian = '$bidang' AND kelas.rombel = $rombel
            GROUP BY siswa.nama
            ");

?>

<table border="1" cellspacing="0">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">No Absen</th>
            <th rowspan="2">Nama Lengkap</th>
            <th colspan="3">Kehadiran</th>
        </tr>
        <tr>
            <th>Sakit</th>
            <th>Izin</th>
            <th>Tanpa Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        <?php foreach ($dataAbsensi as $data) : ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data["no_absen"] ?></td>
                <td class="nama-kolom"><?= ucwords($data["nama"]) ?></td>
                <td><?= $data["sakit"] ?></td>
                <td><?= $data["izin"] ?></td>
                <td><?= $data["tanpa_keterangan"] ?></td>
            </tr>
            <?php $no++ ?>
        <?php endforeach; ?>
    </tbody>
</table>