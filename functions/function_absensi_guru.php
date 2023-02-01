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
  $nip = mysqli_real_escape_string($conn, strtolower($_POST["nip"]));;
  $status = mysqli_real_escape_string($conn, strtolower($_POST["status"]));
  $keterangan = mysqli_real_escape_string($conn, strtolower($_POST["keterangan"]));
  $current_date = date('Y-m-d');

  $done = true;

  if (empty($keterangan)) {
    $keterangan = "-";
  }

  mysqli_query($conn, "INSERT INTO absensi_guru VALUES ('', $nip, '$nama', '$current_date', '$status', '$keterangan')");
}

function isAbsensiDone($nama)
{
  global $conn;

  $current_date = date('Y-m-d');

  $query = "SELECT * FROM absensi_guru WHERE nama = '$nama' AND tanggal = '$current_date'";

  $conn->query($query);


  return mysqli_affected_rows($conn);
}
