<?php

$dataSession = $_SESSION["user"];
$userID = $dataSession["id_operator"];

if (isset($_COOKIE["key"])) {
    $dataCookie = getIdCookie($conn);

    $queryDataCookie = "SELECT *
                FROM user
                WHERE user.id_operator = '$dataCookie[user_id]'";
}

$queryDataSession = "SELECT *
                FROM user
                WHERE user.id_operator = '$userID'";

$dataUser = "";

if (isset($_COOKIE["key"])) {
    $dataUser = getDataFromCookie($conn, $queryDataCookie, $dataCookie);
} else {
    $dataUser = getDataFromSession($conn, $queryDataSession, $userID);
}
