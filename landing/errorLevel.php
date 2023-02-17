<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>halaman error</title>
  <style>
    body {
      min-height: 100vh;
      padding: 0;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    h1 {
      font-size: 4rem;
      font-family: 'Poppins', sans-serif;
      color: red;
      font-style: italic;
    }
  </style>
</head>

<body>
  <h1>Anda tidak terdaftar sebagai apapun!</h1>
  <?php
  session_start();
  var_dump($_SESSION["user"]) ?>
</body>

</html>