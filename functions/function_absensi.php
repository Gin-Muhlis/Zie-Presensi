<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database
$done = null;

if (isset($_POST["kirim-absensi"])) {
  cekAbsensi();
}

function cekAbsensi()
{
  global $conn;
  global $done;

  $nama = mysqli_real_escape_string($conn, strtolower($_POST["nama"]));
  $kelas = mysqli_real_escape_string($conn, strtolower($_POST["kelas"]));
  $no_absen = mysqli_real_escape_string($conn, strtolower($_POST["no_absen"]));
  $status = mysqli_real_escape_string($conn, strtolower($_POST["status"]));
  $keterangan = mysqli_real_escape_string($conn, strtolower($_POST["keterangan"]));
  $current_date = date('Y-m-d');

  setcookie("absen", hash("sha384", $nama), time() + (3600 * 24));

  $done = true;

  if (empty($keterangan)) {
    $keterangan = "-";
  }

  mysqli_query($conn, "INSERT INTO absensi VALUES ('', $no_absen, '$nama', '$kelas', '$current_date', '$status', '$keterangan')");
}
