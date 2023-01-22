<?php
require_once("functions.php"); // !memanggil file functions.php 

checkCookie(); // !menjalankan fungsi untuk mengecek cookie
checkIsSession(); // !menjalankan fungsi untuk mengecek session

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/login.css">
  <title>Login</title>

</head>

<body>
  <div class="wrapper">
    <h1>Login</h1>
    <form action="#" method="POST">
      <label for="nama" class="label-input-text">
        <input type="text" id="nama" name="nama" autocomplete="off" required class="input-text">
        <span>Nama : </span>
      </label>
      <label for="password" class="label-input-text">
        <input type="password" id="password" name="password" autocomplete="off" required class="input-text">
        <span>Password : </span>
      </label>
      <div class="remember">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember" class="label-remember">Remember Me</label>
      </div>
      <!-- !Mengecek ketika ada variabel error tampilkan pesan error -->
      <?php if (isset($error)) : ?>
        <span class="error" style="font-size: 12px; color: red; font-style: italic; margin-block: 8px; font-weight: bold;">
          Username atau Password salah!
        </span>
      <?php endif; ?>
      <button type="submit" name="login">Login</button>
    </form>
  </div>
</body>

</html>