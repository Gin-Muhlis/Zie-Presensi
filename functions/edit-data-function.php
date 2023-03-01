<?php

function editProfile($conn, $post, $user)
{

    $usernameUser = $user["username"];
    $passwordUser = $user["password"];
    $username = htmlspecialchars(mysqli_real_escape_string($conn, $post["username"]));
    $passwordLama = htmlspecialchars(mysqli_real_escape_string($conn, $post["pwLama"]));;
    $passwordBaru = htmlspecialchars(mysqli_real_escape_string($conn, $post["pwBaru"]));;

    $queryForCheck = "SELECT username FROM user";

    $result = $conn->query($queryForCheck);
    $dataCheck = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $dataCheck[] = $row;
    }

    foreach ($dataCheck as $data) {
        if ($username === $data["username"]) {
            echo "<script>
                alert('Username telah digunakan!')
            </script>";

            return false;
        }
    }

    if (!empty($passwordLama) && !empty($passwordBaru)) {
        if ($passwordLama !== $passwordUser) {
            echo "<script>
                alert('Password yang anda masukkan salah!')
            </script>";

            return false;
        }

        $passwordUser = $passwordBaru;
    }

    if ((!empty($passwordLama) && empty($passwordBaru)) || (empty($passwordLama) && !empty($passwordBaru))) {
        echo "<script>
                alert('Password lama dan password baru harus diisi jika anda ingin mengganti password!')
            </script>";

        return false;
    }

    if (empty($username)) {
        $username = $usernameUser;
    }


    $query = "UPDATE user
              SET username = '$username',
              password = '$passwordUser'
              WHERE id = {$user["id"]}";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}

// edit data pribadi 
function editPribadi($conn, $post, $user)
{
    $namaUser = $user["nama"];
    $alamatUser = $user["alamat"];
    $kontakUser = $user["kontak"];

    $role = $user["role"];

    $nama = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["nama"])));
    $alamat = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["alamat"])));
    $kontak = htmlspecialchars(mysqli_real_escape_string($conn, strtolower($post["kontak"])));


    if (empty($nama)) {
        $nama = $namaUser;
    }


    if (empty($alamat)) {
        $alamat = $alamatUser;
    }

    if (empty($kontak)) {
        $kontak = $kontakUser;
    }

    if (!is_numeric($kontak)) {
        echo "<script>
                alert('Kontak hanya boleh berisi angka!')
            </script>";

        return false;
    }


    $query = "UPDATE $role
              SET nama = '$nama',
              alamat = '$alamat',
              kontak = '$kontak'
              WHERE id = {$user['id']}";

    $conn->query($query);

    return mysqli_affected_rows($conn);
}
