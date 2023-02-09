<?php
session_start(); // !memulai session

$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database
$table_database = array("guru", "kepala_sekolah", "siswa"); // !menyimpan nama tabel di dalam array
$levels = array("siswa", "guru", "kepala sekolah", "wali kelas", "operator siswa", "bk"); // !menyimpan jabatan di dalam array
$error = null; // !membuat variabel untuk ketika ada error

if (isset($_POST["login"])) { // !mengecek apakah button login di klik
  checkUser($table_database); // !jika di klik jalankan fungsi checkUser
}

// !---------- function tuntuk mengecek cookie ----------!
function checkCookie()
{
  global $conn; // !membuat variabel $conn bisa diakses
  global $table_database; // !membuat variabel $table_database bisa diakses

  $dataCookie = [];

  $query = $conn->query("SELECT * FROM cookie");

  if (mysqli_num_rows($query) > 0) {
    $dataCookie[] = mysqli_fetch_assoc($query);
    $nama = $dataCookie[0]["user_nama"];
    foreach ($table_database as $table) { // !me looping array tabel database
      $result = mysqli_query($conn, "SELECT * FROM $table WHERE nama = '$nama'"); // !mencari kolom yang sesuai dengan variabel id
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // !menyimpan data dalam bentuk array associative didalam variabel row
        $level = $row["level"]; // !menyimpan data level dalam variabel
        if ($nama === $row["nama"]) { // !mengecek apakah nama yang ada di cookie sama dengan nama yang ada di database
          $_SESSION["login_$level"] = true; // !jika ada set session dengan nama login_level dari datanya
        }
      }
    }
  }
}

// !---------- function untuk mengecek apakah ada session di halaman login ----------!
function checkIsSession()
{
  global $levels; // !membuat variabel $levels bisa diakses

  $check = null; // !membuat variabel untuk menyimpan level yang sesuai kondisi

  for ($i = 0; $i < count($levels); $i++) { // !me looping array levels yang berisi jabatan-jabatan
    if (isset($_SESSION["login_$levels[$i]"])) { // !mengecek apakah ada session dengan namalogin_levels index ke i
      $check = $levels[$i]; // !menyimpan nama level kedalam variabel check

      switch ($check) { // !mengecek isi variabel $check
        case "siswa": // !jika nilai dari variabel check adalah siswa
          header("Location: landing/siswa/siswa.php"); // !arahkan ke halaman siswa
          exit; // !keluar dari function

          break;
        case "operator siswa": // !jika nilai dari variabel check adalah operator siswa
          header("Location: landing/operator siswa/operator_siswa.php"); // !arahkan ke halaman siswa
          exit; // !keluar dari function

          break;
        case "guru": // !jika nilai dari variabel check adalah guru 
          header("Location: landing/guru/guru.php"); // !arahkan ke halaman guru
          exit;

          break;
        case "wali kelas": // !jika nilai dari variabel check adalah wali kelas
          header("Location: landing/wali kelas/wali_kelas.php"); // !arahkan ke halaman wali kelas
          exit;

          break;
        case "kepala sekolah": // !jika nilai dari variabel check adalah kepala sekolah
          header("Location: landing/kepala sekolah/kepala_sekolah.php"); // !arahkan ke halaman kepala sekolah
          exit;

          break;
        case "bk": // !jika nilai dari variabel check adalah kepala sekolah
          header("Location: landing/bk/bk.php"); // !arahkan ke halaman kepala sekolah
          exit;

          break;
        default: // !cek ketika level dari data user tidak sesuai
          header("Location: landing/errorLevel.php"); // !arahkan ke halaman error
          exit;
      }
    } else if ($i === count($levels) && !isset($_SESSION["login_$levels[$i]"])) { // !mengecek ketika i sudah sama dengan pangjang array levels dan tidak ada nama session yang sesuai
      return false; // !keluar dari function
    }
  }
}

function setDataCookie($nama, $id)
{
  global $conn;

  $conn->query("INSERT INTO cookie VALUES ('',$id, '$nama')");

  return mysqli_affected_rows($conn);
}

// !---------- function untuk mengecek data user yang diinputkan ----------!
function checkUser($tables)
{
  global $error; // !membuat variabel $error bisa diakses
  global $conn; // !membuat variabel $conn bisa diakses

  $nama = mysqli_real_escape_string($conn, strtolower($_POST["nama"])); // !menyimpan inputan user yang namenya nama kedalam variabel nama
  $password = mysqli_real_escape_string($conn, $_POST["password"]); // !menyimpan inputan user yang namenya password kedalam variabel password

  foreach ($tables as $table) { // !me looping array tables

    $result = mysqli_query($conn, "SELECT * FROM $table WHERE nama = '$nama'"); // !membuat query untuk mengambil data dari database sesuai dengna nama yang diinput user

    if (mysqli_num_rows($result) === 1) { // !mengecek ketika datanya ada
      $user = mysqli_fetch_assoc($result); // !mengambil datanya dan simpan kedalam variabel

      $level = $user["level"]; // !menyimpan level dari data user ke dalam variabel level

      if (password_verify($password, $user["password"])) { // !mengecek apakah password yang diinput user sama dengan password yang di database
        $_SESSION["login_$level"] = true; // !mengeset session dengan nama login_level user
        $_SESSION["nama"] = $user["nama"]; // !mengeset session dengan nama nama yang diisi nama dari user

        if (isset($_POST["remember"])) { // !mengecek ketika user menekan checkbox remember me
          setDataCookie($user["nama"], $user["id"]);
        }

        switch ($user["level"]) { // !mengecek level dari user yang login lalu arahkan ke halaman yang sesuai dengan level/jabatannya
          case "siswa":
            header("Location: ../zie presensi/landing/siswa/siswa.php");
            exit;

            break;
          case "operator siswa":
            header("Location: landing/operator siswa/operator_siswa.php");
            exit;

            break;
          case "guru":
            header("Location: landing/guru/guru.php");
            exit;

            break;
          case "wali kelas":
            header("Location: landing/wali kelas/wali_kelas.php");
            exit;

            break;
          case "kepala sekolah":
            header("Location: landing/kepala sekolah/kepala_sekolah.php");
            exit;

            break;
          case "bk":
            header("Location: landing/bk/bk.php");
            exit;

            break;
          default:
            header("Location: landing/errorLevel.php");
            exit;
        }
      }
    }
  }
  $error = true; // !mengeset variabel error jika user tidak ditemukan
}

// !---------- cek session ----------!
function checkSession($nameOfSession) // !function untuk mengecek session di halaman landing page
{
  if (!isset($_SESSION[$nameOfSession])) { // !mengecek ketika tidak ada session yang sesuai dengan argumen yang dikirim
    header("Location: ../../login.php"); // !mengarahkan user ke halaman login
    exit;
  }
}

// !---------- ambil data dari database ----------!
function getDataFromCookie() // !function untuk mengambil data dari database sesuai data yang ada di cookie
{
  global $conn; // !membuat variabel $conn bisa diakses
  global $table_database; // !membuat variabel $table_database bisa diakses

  $dataCookie = [];

  $query = $conn->query("SELECT * FROM cookie");

  if (mysqli_num_rows($query)) { // !mengecek apakah ada cookie dengan nama "id" dan "key"
    $dataCookie[] = mysqli_fetch_assoc($query);
    $namaCookie = $dataCookie[0]["user_nama"]; // !menyimpan nilai cooke yang namanya key ke dalam variabel
    $data = null;

    for ($i = 0; $i < count($table_database); $i++) {
      $tabel = $table_database[$i];
      if ($tabel == "siswa") {
        $queryForSiswa = "SELECT siswa.*, kelas.kode
               FROM siswa 
               JOIN kelas
               ON siswa.id_kelas = kelas.id
               WHERE siswa.nama = '$namaCookie'";

        $resultSiswa = $conn->query($queryForSiswa);
        if (mysqli_num_rows($resultSiswa) > 0) {
          $data = mysqli_fetch_assoc($resultSiswa);
          if ($namaCookie == $data["nama"]) {
            return $data;
          }
        }
      } else {
        $queryForElse = "SELECT * FROM $table_database[$i] WHERE nama = '$namaCookie'";
        $resultElse = $conn->query($queryForElse);

        if (mysqli_num_rows($resultElse) > 0) {
          $data = mysqli_fetch_assoc($resultElse);

          if ($namaCookie == $data["nama"]) {
            return $data;
          }
        }
      }
    }
  }

  return false; // !keluar dari function ketika tidak ada cookie yang sesuai
}

function getDataFromSession() // !function untuk mengambil data dari database sesuai data yang ada di session
{
  global $conn; // !membuat variabel $conn bisa diakses
  global $table_database; // !membuat variabel $table_database bisa diakses

  if (isset($_SESSION["nama"])) {
    $nama = $_SESSION["nama"]; // !menyimpan value dari session dengan nama nama kedalam variabel
    $data = null;

    for ($i = 0; $i < count($table_database); $i++) {
      $tabel = $table_database[$i];
      if ($tabel == "siswa") {
        $queryForSiswa = "SELECT siswa.*, kelas.kode
               FROM siswa 
               JOIN kelas
               ON siswa.id_kelas = kelas.id
               WHERE siswa.nama = '$nama'";

        $resultSiswa = $conn->query($queryForSiswa);
        if (mysqli_num_rows($resultSiswa) > 0) {
          $data = mysqli_fetch_assoc($resultSiswa);
          if ($nama == $data["nama"]) {
            return $data;
          }
        }
      } else {
        $queryForElse = "SELECT * FROM $table_database[$i] WHERE nama = '$nama'";
        $resultElse = $conn->query($queryForElse);

        if (mysqli_num_rows($resultElse) > 0) {
          $data = mysqli_fetch_assoc($resultElse);

          if ($nama == $data["nama"]) {
            return $data;
          }
        }
      }
    }
  }

  return false; // !keluar dari function ketika tidak ada cookie yang sesuai
}


function getDataGuru()
{
  global $conn;

  $result = $conn->query("SELECT * FROM guru");

  $data = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  return $data;
}

function getHari()
{
  global $conn;

  $result = $conn->query("SELECT * FROM hari");

  $data = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  return $data;
}

function getKelas()
{
  global $conn;

  $result = $conn->query("SELECT * FROM kelas");

  $data = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  return $data;
}

function uploadImage($nama, $fotoLama, $path)
{
  global $conn;
  global $table_database;

  $tabel = null;

  foreach ($table_database as $table) {
    $tabel = $table;

    $result = $conn->query("SELECT * FROM $tabel WHERE nama = '$nama'");

    if (mysqli_num_rows($result) > 0) {
      $file_name = $_FILES["image"]["name"];
      $file_directory = $_FILES["image"]["tmp_name"];
      $file_size = $_FILES["image"]["size"];
      $error = $_FILES["image"]["error"];

      if ($error === 4) {
        echo "<script>
        alert ('File tidak ditemukan!');
        </script>";
        return false;
      }

      $validExtension = array("jpg", "jpeg", "png");
      $extension = explode(".", $file_name);
      $extension = strtolower(end($extension));

      if (!in_array($extension, $validExtension)) {
        echo "<script>
        alert ('Anda hanya bisa mengupload gambar!');
        </script>";
        return false;
      }

      if ($file_size > 1000000) {
        echo "<script>
        alert ('Gambar terlalu besar!');
        </script>";
        return false;
      }

      $newName = uniqid();
      $newName = $newName . "." . $extension;

      if (strlen($fotoLama)) {
        unlink($fotoLama);
      }

      move_uploaded_file($file_directory, $path . $newName);

      $conn->query("UPDATE $tabel SET foto = '$newName' WHERE nama = '$nama'");

      return mysqli_affected_rows($conn);
    }
  }
}

function getNIS()
{
  global $conn;

  $result = $conn->query("SELECT nis FROM siswa");

  $data = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  return $data;
}
