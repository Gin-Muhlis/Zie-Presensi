<?php
$conn = mysqli_connect("localhost", "root", "", "school"); // !koneksi ke database

function getDataAbsensiGuru($query)
{
    global $conn;

    $data = [];

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}
