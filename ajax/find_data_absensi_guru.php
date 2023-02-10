<?php
require "../functions/function_data_absensi_guru.php";

$keyword = mysqli_real_escape_string($conn, strtolower($_GET["keyword"]));

$query = "SELECT * FROM absensi_guru
         WHERE
            nama LIKE '%$keyword%' OR nip LIKE '%$keyword%' OR tanggal LIKE '%$keyword%' OR status LIKE '%$keyword%'";


$dataAbsensi = getDataAbsensiGuru($query);

?>

<table border="1" cellspacing="0">
    <thead>
        <th>No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($dataAbsensi as $data) : ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data["nip"] ?></td>
                <td><?= ucwords($data["nama"]) ?></td>
                <td><?= $data["tanggal"] ?></td>
                <td><?= ucwords($data["status"]) ?></td>
                <td><?= ucfirst($data["keterangan"]) ?></td>
            </tr>
            <?php $no++; ?>
        <?php endforeach ?>
    </tbody>
</table>