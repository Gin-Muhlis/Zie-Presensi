<?php

$dataSession = $_SESSION["user"];
$userID = $dataSession["id_operator"];

if (isset($_COOKIE["key"])) {
    $dataCookie = getIdCookie($conn);

    $queryDataCookie = "SELECT user.username, user.role, user.id_operator, user.password, user.foto, guru.*
              FROM user
              JOIN guru ON user.id = guru.id
              WHERE user.id_operator = '$dataCookie[user_id]'";
}

$queryDataSession = "SELECT user.username, user.role, user.id_operator, user.password, user.foto, guru.*
              FROM user
              JOIN guru ON user.id = guru.id
              WHERE user.id_operator = '$userID'";

$dataUser = "";

if (isset($_COOKIE["key"])) {
    $dataUser = getDataFromCookie($conn, $queryDataCookie, $dataCookie);
} else {
    $dataUser = getDataFromSession($conn, $queryDataSession, $userID);
}
