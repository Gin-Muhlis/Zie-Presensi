<?php

$jumlahDataPerHalaman = 5;
$DataDatabase = $conn->query("SELECT * FROM guru");
$jumlahData = mysqli_num_rows($DataDatabase);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["hal"])) ? $_GET["hal"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
$no = 1;
