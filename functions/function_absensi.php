<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database


if (isset($_POST["kirim-absensi"])) {
  cekAbsensi();
}

function cekAbsensi()
{
  $nama = $_POST["nama"];
}
