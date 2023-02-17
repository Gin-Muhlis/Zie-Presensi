<?php
require "../functions/function_data_absensi.php";

$keyword = mysqli_real_escape_string($conn, strtolower($_GET["keyword"]));
$kodeKelas = strtolower($_GET["dataKelas"]);
$query = "SELECT * FROM absensi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
         WHERE
         kelas = '$kodeKelas' AND
         (nama LIKE '%$keyword%' OR no_absen LIKE '%$keyword%' OR tanggal LIKE '%$keyword%' OR status LIKE '%$keyword%')";


$dataAbsensi = getDataAbsensi($query);
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
                <td><?= ucwords($data["nama"]) ?></td>
                <td><?= $data["tanggal"] ?></td>
                <td class="status" <?php
                                    switch ($data["status"]) {
                                        case "hadir":
                                            echo "style='background: #54B435;'";
                                            break;
                                        case "izin":
                                            echo "style='background: #4B56D2;'";
                                            break;
                                        case "sakit":
                                            echo "style='background: #FF1E1E;'";
                                            break;
                                        default:
                                            echo "style='background: #2C3333;'";
                                    }
                                    ?>><?= ucwords($data["status"]) ?></td>
                <td><?= $data["keterangan"] ?></td>
                <td>
                    <a href="edit_absensi.php?id=<?= $data['id'] ?>">Edit</a> | <a href="hapus_absensi.php?id=<?= $data['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')">Hapus</a>
                </td>
            </tr>
            <?php $no++ ?>
        <?php endforeach; ?>
    </tbody>
</table>