<?php

// ambil data
function getDataForm($conn, $query)
{

    $result = $conn->query($query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

// tambah catatan konsultasi
function tambahCatatan($conn, $post)
{

    $thn_ajaran = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["tahunAjaran"])));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["nama"])));
    $waliKelas = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["waliKelas"])));
    $kasus = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["kasus"])));
    $penanganan = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["penanganan"])));
    $status = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["status"])));
    $current_date = date('Y-m-d');
    $dokumentasi = validasiImageCatatan();

    // !Validasi Form
    if (empty($kasus) || empty($penanganan)) {
        echo "<script>
            alert ('Field tidak boloh kosong!');
        </script>";
        return false;
    }

    if (!preg_match('/^[a-zA-Z0-9\s.,]+$/', $kasus) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $penanganan)) {
        echo "<script>
            alert ('Anda memasukkan karakter yang tidak diperbolehkan!');
        </script>";
        return false;
    }

    if (!$dokumentasi) {
        return false;
    }

    $query = "INSERT INTO konsultasi VALUES ('', '$thn_ajaran', '$nama', '$waliKelas', '$kasus', '$penanganan', '$dokumentasi', '$status', '$current_date')";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}


function validasiImageCatatan()
{

    $file_name = $_FILES["dokumentasi"]["name"];
    $file_directory = $_FILES["dokumentasi"]["tmp_name"];
    $file_size = $_FILES["dokumentasi"]["size"];

    $validExtension = array("jpg", "jpeg", "png");
    $extension = explode(".", $file_name);
    $extension = strtolower(end($extension));

    if ($_FILES["dokumentasi"]["error"] !== 4) {
        if (!in_array($extension, $validExtension)) {
            echo "<script>
        alert ('Anda hanya bisa mengupload gambar!!!');
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

        move_uploaded_file($file_directory, "../../../image/" . $newName);

        return $newName;
    }

    return "-";
}

// edit catatan konsultasi

function editCatatan($conn, $post, $id)
{
    global $conn;

    $thn_ajaran = htmlspecialchars(mysqli_real_escape_string($conn, $post["tahunAjaran"]));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["nama"])));
    $waliKelas = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["waliKelas"])));
    $kasus = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["kasus"])));
    $penanganan = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["penanganan"])));
    $status = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["status"])));
    $gambarLama = $post["gambarLama"];

    if ($_FILES["dokumentasi"]["error"] == 4) {
        $dokumentasi = $gambarLama;
    } else {
        $dokumentasi = validasiImageCatatan();
    }

    // !Validasi Form
    if (empty($kasus) || empty($penanganan)) {
        echo "<script>
            alert ('Field tidak boloh kosong!');
        </script>";
        return false;
    }

    if (!preg_match('/^[a-zA-Z0-9\s.,]+$/', $kasus) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $penanganan)) {
        echo "<script>
            alert ('Anda memasukkan karakter yang tidak diperbolehkan!');
        </script>";
        return false;
    }

    if (!$dokumentasi) {
        return false;
    }

    if (!$_FILES["dokumentasi"]["error"] == 4) {
        unlink("../../../image/$gambarLama");
    }

    $query = "UPDATE konsultasi
             SET id_th_ajaran = $thn_ajaran,
             id_siswa = '$nama',
             id_walas = '$waliKelas',
             kasus = '$kasus',
             penanganan = '$penanganan',
             status = '$status',
             dokumentasi = '$dokumentasi'
             WHERE id = $id";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}
