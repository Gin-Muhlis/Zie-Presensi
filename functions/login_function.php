<?php
session_start();

$error = null;

// Fungsi untuk mengecek apakah user telah login atau belum
function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengecek apakah user memiliki role tertentu
function hasRole($role)
{
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if ($user['hak_akses'] == $role) {
            return true;
        }
    }
    return false;
}

// Fungsi untuk melakukan login
function login($conn)
{
    global $error;
    // ambil username dan password
    $username = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["username"]));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["password"]));
    // cari data
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // cek apakah data ada atau tidak
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if ($username === $user["username"] && $password === $user["password"]) {
            // set session
            $_SESSION['user'] = $user;

            // set cookie
            if (isset($_POST["remember"])) {
                setDataCookie($user["id_operator"], $user["username"], $conn);
            }

            switch ($user["hak_akses"]) { // !mengecek isi variabel $check
                case "siswa kelas": // !jika nilai dari variabel check adalah siswa
                    header("Location: landing/siswa/siswa.php"); // !arahkan ke halaman siswa
                    exit; // !keluar dari function

                    break;
                case "operator siswa": // !jika nilai dari variabel check adalah operator siswa
                    header("Location: landing/operator siswa/operator_siswa.php"); // !arahkan ke halaman siswa
                    exit; // !keluar dari function

                    break;
                case "umum": // !jika nilai dari variabel check adalah guru 
                    header("Location: landing/guru/guru.php"); // !arahkan ke halaman guru
                    exit;

                    break;
                case "walas": // !jika nilai dari variabel check adalah wali kelas
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
                    break;
                case "admin": // !jika nilai dari variabel check adalah kepala sekolah
                    header("Location: landing/admin/admin.php"); // !arahkan ke halaman kepala sekolah
                    exit;

                    break;
                default: // !cek ketika level dari data user tidak sesuai
                    header("Location: landing/errorLevel.php"); // !arahkan ke halaman error
                    exit;
            }
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}

function checkSession()
{
    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"];

        switch ($user["hak_akses"]) { // !mengecek isi variabel $check
            case "siswa kelas": // !jika nilai dari variabel check adalah siswa
                header("Location: landing/siswa/siswa.php"); // !arahkan ke halaman siswa
                exit; // !keluar dari function

                break;
            case "operator siswa": // !jika nilai dari variabel check adalah operator siswa
                header("Location: landing/operator siswa/operator_siswa.php"); // !arahkan ke halaman siswa
                exit; // !keluar dari function

                break;
            case "umum": // !jika nilai dari variabel check adalah guru 
                header("Location: landing/guru/guru.php"); // !arahkan ke halaman guru
                exit;

                break;
            case "walas": // !jika nilai dari variabel check adalah wali kelas
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
            case "admin": // !jika nilai dari variabel check adalah kepala sekolah
                header("Location: landing/admin/admin.php"); // !arahkan ke halaman kepala sekolah
                exit;

                break;
            default: // !cek ketika level dari data user tidak sesuai
                header("Location: landing/errorLevel.php"); // !arahkan ke halaman error
                exit;
        }
    }
}

// cek cookie
function checkCookie($conn)
{

    if (isset($_COOKIE["key"])) {
        $key = $_COOKIE["key"];

        $query = $conn->query("SELECT * FROM cookie WHERE uniq_key = '$key'");

        if (mysqli_num_rows($query) > 0) {
            $dataCookie = mysqli_fetch_assoc($query);
            $userID = $dataCookie["user_id"];

            $result = mysqli_query($conn, "SELECT * FROM user WHERE id_operator = '$userID'");

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                if ($userID === $row["id_operator"]) {
                    $_SESSION["user"] = $row;
                }
            }
        }
    }
}

// set cookie ke databqase
function setDataCookie($idOperator, $username, $conn)
{
    $uniqueID = uniqid();

    $conn->query("INSERT INTO cookie VALUES('','$idOperator', '$username', '$uniqueID')");

    setcookie("key", $uniqueID, time() + (3600 * 100000));

    return mysqli_affected_rows($conn);
}

// mengambil user_id dari cookie user
function getIdCookie($conn)
{
    if (isset($_COOKIE["key"])) {
        $key = $_COOKIE["key"];
        $query = $conn->query("SELECT * FROM cookie WHERE uniq_key = '$key'");

        if (mysqli_num_rows($query) > 0) {
            $dataCookie = mysqli_fetch_assoc($query);

            return $dataCookie;
        }
    }
}

// mengambil data from cookie
function getDataFromCookie($conn, $queryData, $dataCookie)
{

    $userID = $dataCookie["user_id"];

    $result = mysqli_query($conn, $queryData);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($userID === $row["id_operator"]) {
            return $row;
        }
    }


    return false;
}

// ambil data from session
function getDataFromSession($conn, $query, $userID)
{

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($userID === $row["id_operator"]) {
            return $row;
        }
    }

    return false;
}
