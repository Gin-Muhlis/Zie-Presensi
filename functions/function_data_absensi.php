<?php     
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

function getDataAbsensi($getQuery) {
    global $conn;

    $query = $conn->query($getQuery);

    $dataAbsensi = [];

    while($row = $query->fetch_assoc()) {
        $dataAbsensi[] = $row;
    }

    return $dataAbsensi;
}

?>