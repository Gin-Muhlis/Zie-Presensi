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

  $nama = strtolower($_POST["nama"]);
  $kelas = strtolower($_POST["kelas"]);
  $no_absen = $_POST["no_absen"];
  $status = strtolower($_POST["status"]);
  $keterangan = strtolower($_POST["keterangan"]);
  $current_date = date('Y-m-d');

  setcookie("absen", hash("sha384", $nama), time() + 86400);
  $done = true;
  if (empty($keterangan)) {
    $keterangan = "-";
  }

  mysqli_query($conn, "INSERT INTO absensi VALUES ('', $no_absen, '$nama', '$kelas', '$current_date', '$status', '$keterangan')");

  mysqli_affected_rows($conn);
}

function getDataFromSession() // !function untuk mengambil data dari database sesuai data yang ada di cookie
{
  global $conn; // !membuat variabel $conn bisa diakses
  global $table_database; // !membuat variabel $table_database bisa diakses

  if (isset($_SESSION["nama"])) {
    $nama = $_SESSION["nama"]; // !menyimpan value dari session dengan nama nama kedalam variabel

    foreach ($table_database as $table) { // !me looping array nama table
      $query = "SELECT $table.*, kelas.kode
                FROM $table 
                JOIN kelas
                ON $table.id_kelas = kelas.id
                WHERE $table.nama = '$nama'";
      $result = mysqli_query($conn, $query); // !membuat query untuk mengambil data sesuai session yang ada

      if (mysqli_num_rows($result) === 1) { // !mengecek apakah variabel $result ada isinya
        $user = mysqli_fetch_assoc($result); // !simpan data yang sesuai kedalam variabel dataUser
        if ($nama === $user["nama"]) {
          return $user;
        }
      }
    }
  }


  return false; // !keluar dari function ketika tidak ada cookie yang sesuai
}
