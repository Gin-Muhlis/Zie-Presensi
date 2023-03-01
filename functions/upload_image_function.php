<?php

function uploadImage($conn, $id, $path, $fotoLama)
{
    $image = validasiImage($path, $fotoLama);

    $query = "UPDATE user
             SET foto = '$image'
             WHERE id = $id";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}

function validasiImage($path, $fotoLama)
{
    $file_name = $_FILES["image"]["name"];
    $file_directory = $_FILES["image"]["tmp_name"];
    $file_size = $_FILES["image"]["size"];

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

    if ($fotoLama !== "$path" . "default.jpg") {
        unlink($fotoLama);
    }

    move_uploaded_file($file_directory, $path . $newName);

    return $newName;
}
