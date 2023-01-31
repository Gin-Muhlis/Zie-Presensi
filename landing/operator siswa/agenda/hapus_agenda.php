<?php
$conn = mysqli_connect("localhost", "root", "", "school");

$id = $_GET["id"];
$conn->query("DELETE FROM agenda WHERE id = $id");

Header("Location: agenda.php");
