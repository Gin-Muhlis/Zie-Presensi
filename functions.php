<?php
session_start(); // !memulai session

$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database
$table_database = array("siswa", "guru", "kepala_sekolah"); // !menyimpan nama tabel di dalam array
$levels = array("siswa", "guru", "kepala sekolah", "wali kelas"); // !menyimpan jabatan di dalam array
$error = null; // !membuat variabel untuk ketika ada error

if (isset($_POST["login"])) { // !mengecek apakah button login di klik
  checkUser($table_database); // !jika di klik jalankan fungsi checkUser
}

function checkCookie() // !function untuk mengecek cookie
{
  global $conn; // !membuat variabel $conn bisa diakses
  global $table_database; // !membuat variabel $table_database bisa diakses

  if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) { // !mengecek apakah ada cookie dengan nama "id" dan "key"
    $id = $_COOKIE["id"]; // !menyimpan nilai cookie id didalam variabel
    $nama = $_COOKIE["key"]; // !menyimpan nilai cookie key didalam variabel

    foreach ($table_database as $table) { // !me looping array tabel database
      $result = mysqli_query($conn, "SELECT * FROM $table WHERE id = $id"); // !mencari kolom yang sesuai dengan variabel id
      $row = mysqli_fetch_assoc($result); // !menyimpan data dalam bentuk array associative didalam variabel row
      $level = $row["level"]; // !menyimpan data level dalam variabel
      if ($nama === hash("sha384", $row["nama"])) { // !mengecek apakah nama yang ada di cookie sama dengan nama yang ada di database
        $_SESSION["login_$level"] = true; // !jika ada set session dengan nama login_level dari datanya
      }
    }
  }
}


function checkIsSession() // !functin untuk mengecek apakah ada session di halaman login
{
  global $levels; // !membuat variabel $levels bisa diakses

  $check = null; // !membuat variabel untuk menyimpan level yang sesuai kondisi

  for ($i = 0; $i < count($levels); $i++) { // !me looping array levels yang berisi jabatan-jabatan
    if (isset($_SESSION["login_$levels[$i]"])) { // !mengecek apakah ada session dengan namalogin_levels index ke i
      $check = $levels[$i]; // !menyimpan nama level kedalam variabel check

      switch ($check) { // !mengecek isi variabel $check
        case "siswa": // !jika nilai dari variabel check adalah siswa
          header("Location: landing/siswa.php"); // !arahkan ke halaman siswa
          exit; // !keluar dari function

          break;
        case "guru": // !jika nilai dari variabel check adalah guru 
          header("Location: landing/guru.php"); // !arahkan ke halaman guru
          exit;

          break;
        case "wali kelas": // !jika nilai dari variabel check adalah wali kelas
          header("Location: landing/wali_kelas.php"); // !arahkan ke halaman wali kelas
          exit;

          break;
        case "kepala sekolah": // !jika nilai dari variabel check adalah kepala sekolah
          header("Location: landing/kepala_sekolah.php"); // !arahkan ke halaman kepala sekolah
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

function checkUser($tables) // !function untuk mengecek data user yang di input
{
  global $error; // !membuat variabel $error bisa diakses
  global $conn; // !membuat variabel $conn bisa diakses

  foreach ($tables as $table) { // !me looping array tables

    $nama = $_POST["nama"]; // !menyimpan inputan user yang namenya nama kedalam variabel nama
    $password = $_POST["password"]; // !menyimpan inputan user yang namenya password kedalam variabel password

    $result = mysqli_query($conn, "SELECT * FROM $table WHERE nama = '$nama'"); // !membuat query untkk mengamil data dari database sesuai dengna nama yang diinput user

    if (mysqli_num_rows($result) === 1) { // !mengecek ketika datanya ada
      $user = mysqli_fetch_assoc($result); // !mengambil datanya dan simpan kedalam variabel

      $level = $user["level"]; // !menyimpan level dari data user ke dalam variabel level

      if (password_verify($password, $user["password"])) { // !mengecek apakah password yang diinput user sama dengan password yang di database
        $_SESSION["login_$level"] = true; // !mengeset session dengan nama login_level user
        $_SESSION["nama"] = $user["nama"]; // !mengeset session dengan nama nama yang diisi nama dari user

        if (isset($_POST["remember"])) { // !mengecek ketika user menekan checkbox remember me
          setcookie("id", $user["id"], time() + 30000); // !mengeset cookie dengan nama id diisi dengan id user
          setcookie("key", hash("sha384", $user["nama"]), time() + 30000); // !mengeset cookie dengan nama key diisi dengan hash dari nama user
        }

        switch ($user["level"]) { // !mengecek level dari user yang login lalu arahkan ke halaman yang sesuai dengan level/jabatannya
          case "siswa":
            header("Location: landing/siswa.php");
            exit;

            break;
          case "guru":
            header("Location: landing/guru.php");
            exit;

            break;
          case "wali kelas":

            exit;

            break;
          case "kepala sekolah":
            header("Location: landing/kepala_sekolah.php");
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

// !cek session
function checkSession($nameOfSession) // !function untuk mengecek session di halaman landing page
{
  if (!isset($_SESSION[$nameOfSession])) { // !mengecek ketika tidak ada session yang sesuai dengan argumen yang dikirim
    header("Location: ../login.php"); // !mengarahkan user ke halaman login
    exit;
  }
}

// !ambil data dari database 
function getDataFromCookie() // !function untuk mengambil data dari database sesuai data yang ada di cookie
{
  global $conn; // !membuat variabel $conn bisa diakses
  global $table_database; // !membuat variabel $table_database bisa diakses

  if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) { // !mengecek apakah ada cookie dengan nama "id" dan "key"
    $id = $_COOKIE["id"]; // !menyimpan nilai cookie yang namanya id ke dalam variabel 
    $namaCookie = $_COOKIE["key"]; // !menyimpan nilai cooke yang namanya key ke dalam variabel

    foreach ($table_database as $table) { // !me looping array nama tabel
      $result = mysqli_query($conn, "SELECT * FROM $table WHERE id = $id"); // !membuat query untuk mengambil data yang id sama dengan variabel id

      if (mysqli_num_rows($result) === 1) { // !mengecek apakah $result ada isinya
        $user = mysqli_fetch_assoc($result); // !menyimpan data yang sesuai ke dalam variabel

        if ($namaCookie === hash("sha384", $user["nama"])) { // !mengecek apakah hash nama yang ada di cookie sama dengan hash nama dari data yang diambil
          return $user; // !mengembalikan variabel $user
        }
      }
    }
  }

  return false; // !keluar dari function ketika tidak ada cookie yang sesuai
}
