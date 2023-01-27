<?php
session_start(); // !Memulai session 

session_unset(); // !menghapus session
session_destroy(); // !menghapus session

setcookie("id", "", time() - 3600); // !menghapus cookie user dan mengganti dengan yang salah
setcookie("key", "", time() - 3600); // !menghapus cookie user dan mengganti dengan yang salahd

header("Location: ./login.php"); // !untuk redirect ke halaman login