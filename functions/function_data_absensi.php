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


function editAbsensi($id)
{
    global $conn;

    $nama = strtolower($_POST["nama"]);
    $kelas = strtolower($_POST["kelas"]);
    $no_absen = $_POST["no_absen"];
    $status = strtolower($_POST["status"]);
    $keterangan = strtolower($_POST["keterangan"]);
    $current_date = date('Y-m-d');

    if (empty($keterangan)) {
        $keterangan = "-";
    }

    $query = "UPDATE absensi
             SET no_absen = $no_absen,
                 nama = '$nama',
                 kelas = '$kelas',
                 tanggal = '$current_date',
                 status = '$status',
                 keterangan = '$keterangan'
             WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
