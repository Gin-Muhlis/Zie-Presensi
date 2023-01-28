<?php
require "../functions/function_data_absensi.php";

$keyword = $_GET["keyword"];
$query = "SELECT * FROM absensi WHERE"

?>

<table border="1" cellspacing="0">
    <thead>
        <th>No</th>
        <th>No Absen</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        <?php foreach ($dataAbsensi as $data) : ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data["no_absen"] ?></td>
                <td><?= $data["nama"] ?></td>
                <td><?= $data["tanggal"] ?></td>
                <td><?= $data["status"] ?></td>
                <td><?= $data["keterangan"] ?></td>
                <td>
                    <a href="edit_absensi.php">Edit</a> | <a href="hapus_absensi.php" onclick="return confirm('Apakah anda yakin ingin mengahpusnya?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>