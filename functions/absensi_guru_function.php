<?php 

// cek kehadiran guru
function cekKehadiran($conn, $namaGuru) {
    $current_date = date("Y-m-d");
    $query = "SELECT pembelajaran.* 
    FROM guru 
    JOIN pengampu ON guru.id = pengampu.id_guru 
    JOIN pembelajaran ON pengampu.id = pembelajaran.id_pengampu 
    WHERE guru.nama = '$namaGuru' AND pembelajaran.keterangan = 'masuk'";

    $result = $conn->query($query);
    $data = false;

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    }

    return $data;

}

?>