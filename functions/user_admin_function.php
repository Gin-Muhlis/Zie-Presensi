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
