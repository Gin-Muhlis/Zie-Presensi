<?php

// ambil data user
function getUser($conn, $query)
{
    $result = $conn->query($query);

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["username"] !== "admin") {
            $data[] = $row;
        }
    }

    return $data;
}

// tambah data user
function tambahUser($conn, $post)
{
    $id_operator = htmlspecialchars(mysqli_real_escape_string($conn, $post["id_operator"]));
    $username = htmlspecialchars(mysqli_real_escape_string($conn, $post["username"]));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $post["password"]));
    $role = htmlspecialchars(mysqli_real_escape_string($conn, $post["role"]));
    $hak_akses = htmlspecialchars(mysqli_real_escape_string($conn, $post["hak_akses"]));
    $foto = "default.jpg";
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user(id_operator, username, password, role, hak_akses, foto) VALUES ('$id_operator', '$username', '$password_hash', '$role', '$hak_akses', '$foto')";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}

// edit user
function editUser($conn, $post, $id)
{
    $id_operator = htmlspecialchars(mysqli_real_escape_string($conn, $post["id_operator"]));
    $username = htmlspecialchars(mysqli_real_escape_string($conn, $post["username"]));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $post["password"]));
    $role = htmlspecialchars(mysqli_real_escape_string($conn, $post["role"]));
    $hak_akses = htmlspecialchars(mysqli_real_escape_string($conn, $post["hak_akses"]));
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $fotoLama = $post["fotoLama"];

    if ($_FILES["foto"]["error"] == 4) {
        $foto = $fotoLama;
    } else {
        $foto = validasiImageUser($fotoLama);
    }


    $query = "UPDATE user
              SET id_operator = '$id_operator',
              username = '$username',
              password ='$password_hash',
              role = '$role',
              hak_akses = '$hak_akses',
              foto = '$foto'
              WHERE id = $id";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}

function validasiImageUser($fotoLama)
{
    $file_name = $_FILES["foto"]["name"];
    $file_directory = $_FILES["foto"]["tmp_name"];
    $file_size = $_FILES["foto"]["size"];

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



    if ($fotoLama !== "../../../image/default.jpg") {
        unlink("../../../image/" . $fotoLama);
        echo "<script>
        alert ('Gambar dihapus!');
        </script>";
    }

    move_uploaded_file($file_directory, "../../../image/" . $newName);

    return $newName;
}

// hapus data user
function hapusUser($conn, $id)
{
    $query = "DELETE FROM user WHERE id = $id";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}
