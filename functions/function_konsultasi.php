<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

function tambahCatatan($post)
{
    global $conn;

    $nis = htmlspecialchars(mysqli_real_escape_string($conn, $post["nis"]));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["nama"])));
    $kelas = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["kelas"])));
    $waliKelas = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["waliKelas"])));
    $guruBK = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["guruBk"])));
    $jenis = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["jenis"])));
    $rangkuman = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["rangkuman"])));
    $penanganan = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["penanganan"])));
    $status = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["status"])));
    $current_date = date('Y-m-d');
    $dokumentasi = validasiImage();

    // !Validasi Form
    if (empty($nama) || empty($waliKelas) || empty($guruBK) || empty($penanganan)) {
        echo "<script>
            alert ('Field tidak boloh kosong!');
        </script>";
        return false;
    }

    if (!preg_match('/^[a-zA-Z0-9\s.,]+$/', $nama) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $waliKelas) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $guruBK) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $rangkuman) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $penanganan)) {
        echo "<script>
            alert ('Anda memasukkan karakter yang tidak diperbolehkan!');
        </script>";
        return false;
    }

    if (!$dokumentasi) {
        return false;
    }

    $query = "INSERT INTO konsultasi VALUES ('', $nis, '$nama', '$kelas', '$waliKelas', '$guruBK', '$jenis', '$rangkuman', '$penanganan', '$status', '$dokumentasi', '$current_date')";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}

function validasiImage()
{
    $file_name = $_FILES["dokumentasi"]["name"];
    $file_directory = $_FILES["dokumentasi"]["tmp_name"];
    $file_size = $_FILES["dokumentasi"]["size"];

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

    move_uploaded_file($file_directory, "../../image/" . $newName);

    return $newName;
}

function getDataKonsultasi($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function editCatatan($post, $id)
{
    global $conn;

    $nis = htmlspecialchars(mysqli_real_escape_string($conn, $post["nis"]));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["nama"])));
    $kelas = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["kelas"])));
    $waliKelas = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["waliKelas"])));
    $guruBK = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["guruBk"])));
    $jenis = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["jenis"])));
    $rangkuman = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["rangkuman"])));
    $penanganan = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["penanganan"])));
    $status = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["status"])));
    $gambarLama = $post["gambarLama"];

    if ($_FILES["dokumentasi"]["error"] == 4) {
        $dokumentasi = $gambarLama;
    } else {
        $dokumentasi = validasiImage();
    }

    // !Validasi Form
    if (empty($nama) || empty($waliKelas) || empty($guruBK) || empty($penanganan)) {
        echo "<script>
            alert ('Field tidak boloh kosong!');
        </script>";
        return false;
    }

    if (!preg_match('/^[a-zA-Z0-9\s.,]+$/', $nama) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $waliKelas) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $guruBK) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $rangkuman) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $penanganan)) {
        echo "<script>
            alert ('Anda memasukkan karakter yang tidak diperbolehkan!');
        </script>";
        return false;
    }

    if (!$dokumentasi) {
        return false;
    }

    if (!$_FILES["dokumentasi"]["error"] == 4) {
        unlink("../../image/$gambarLama");
    }

    $query = "UPDATE konsultasi
             SET nis_siswa = $nis,
             nama_siswa = '$nama',
             kelas_siswa = '$kelas',
             waliKelas_siswa = '$waliKelas',
             guruBK_siswa = '$guruBK',
             jenisKonsultasi = '$jenis',
             rangkumanKonsultasi = '$rangkuman',
             penanganan = '$penanganan',
             status = '$status',
             dokumentasi = '$dokumentasi'
             WHERE id = $id";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}
