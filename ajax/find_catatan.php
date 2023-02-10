<?php
require "../functions/function_konsultasi.php"; // !memanggil file functions.php

$keyword = mysqli_real_escape_string($conn, strtolower($_GET["keyword"]));

if ($keyword == "semua") {
    $query = "SELECT id, nama_siswa, tanggal, status FROM konsultasi";
} else {
    $keyword = $keyword < 10 ? "0" . $keyword : $keyword;
    $query = "SELECT id, nama_siswa, tanggal, status FROM konsultasi WHERE MONTH(tanggal) = '$keyword'";
}


$dataCatatan = getDataKonsultasi($query);

?>
<?php foreach ($dataCatatan as $data) : ?>
    <div class="row <?php if ($data["status"] == "diproses") {
                        echo "diproses";
                    } else {
                        echo "selesai";
                    } ?>">
        <h3><?= ucwords($data["nama_siswa"]) ?></h3>
        <p><?= $data["tanggal"] ?></p>
        <a href="detailCatatan.php?id=<?= $data["id"] ?>"><i class="fa-sharp fa-solid fa-arrow-right detail"></i></a>
    </div>
<?php endforeach; ?>