<?php
require "../functions/function_data_absensi.php"; // !memanggil file functions.php

$keyword = mysqli_real_escape_string($conn, strtolower($_GET["keyword"]));

if (strlen($keyword) > 0) {
    $query = "SELECT * FROM absensi
         WHERE kelas = '$keyword'";
} else {
    $query = "SELECT * FROM absensi";
}


$dataAbsensi = getDataAbsensi($query);

?>

<table border="1" cellspacing="0">
    <thead>
        <th>No</th>
        <th>Absen</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($dataAbsensi as $data) : ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data["no_absen"] ?></td>
                <td><?= ucwords($data["nama"]) ?></td>
                <td><?= strtoupper($data["kelas"]) ?></td>
                <td><?= $data["tanggal"] ?></td>
                <td><?= ucwords($data["status"]) ?></td>
                <td><?= ucfirst($data["keterangan"]) ?></td>
            </tr>
            <?php $no++; ?>
        <?php endforeach ?>
    </tbody>
</table>