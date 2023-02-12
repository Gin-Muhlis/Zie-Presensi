<?php
require "../functions/function_agenda.php"; // !memanggil file functions_data_absensi.php

$dataKelas = $_GET["dataKelas"];

$query = "SELECT * FROM agenda WHERE kelas = '$dataKelas'";

$dataAgenda = getDataAgenda($query);

?>

<table border="" 1 cellspacing="0">
    <thead>
        <th>No</th>
        <th>Tanggal</th>
        <th>Guru</th>
        <th>Jam</th>
        <th>Materi</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        <?php if (count($dataAgenda) !== 0) : ?>
            <?php $no = 1; ?>
            <?php foreach ($dataAgenda as $agenda) : ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $agenda["tanggal"] ?></td>
                    <td><?= ucwords($agenda["pengajar"]) ?></td>
                    <td><?= ucwords($agenda["jam"]) ?></td>
                    <td><?= ucfirst($agenda["materi"]) ?></td>
                    <td><?= ucfirst($agenda["keterangan"]) ?></td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">AGENDA TIDAK DITEMUKAN</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>