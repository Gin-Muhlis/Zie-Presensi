<?php
require "../functions/functionMapel.php"; // !memanggil file functions.php

$keyword = mysqli_real_escape_string($conn, strtolower($_GET["keyword"]));
$kode = mysqli_real_escape_string($conn, strtolower($_GET["kelas"]));

$mataPelajaran = getDataMapel($kode, $keyword);

?>

<table border="1" cellspacing="0">
    <thead>
        <th>No</th>
        <th>Jam</th>
        <th>Mata Pelajaran</th>
        <th>Pengajar</th>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        <?php foreach ($mataPelajaran as $mapel) : ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $mapel["jam_mulai"] ?> - <?= $mapel["jam_selesai"] ?></td>
                <td><?= $mapel["nama_mapel"] ?></td>
                <td><?= ucwords($mapel["nama_guru"]) ?></td>
            </tr>
            <?php $no++; ?>
        <?php endforeach; ?>
    </tbody>
</table>