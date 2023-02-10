<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CustomCSS -->
    <link rel="stylesheet" href="css/login/login.css">
    <!-- Bootstrap CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- bootstrap sekiranya cdnnya down -->
    <script>
        var test = document.createElement("div")
        test.className = "hidden d-none"

        document.head.appendChild(test)
        var cssLoaded = window.getComputedStyle(test).display === "none"
        document.head.removeChild(test)

        if (!cssLoaded) {
            var link = document.createElement("link");

            link.type = "text/css";
            link.rel = "stylesheet";
            link.href = "bootstrap-5.2.3-dist/css/bootstrap.min.css";

            document.head.appendChild(link);
        }
    </script>
</head>

<body>

    <header>
        <div class="hero">
            <div class="text-container">
                <h1>Selamat Datang!</h1>
                <p>ZiePresensi</p>
            </div>
        </div>
        <div class="wrapper logform">
            <div class="buledan">
                <img src="image/EllipseTest.png" alt="" srcset="">
            </div>
            <form action="login.php" method="post">
                <div class="form-container">
                    <div class="user input">
                        <input placeholder="Username" class="inputelement" type="text" id="username" name="nama" required>
                    </div>
                    <div class="pass input">
                        <input placeholder="Password" class="inputelement" type="password" id="password" name="password" required>
                    </div>
                    <div class="rememberinput">
                        <input type="checkbox" id="rememberme" name="rememberme">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="button">
                        <button name="login" type="submit">LOGIN</button>
                    </div>


                </div>
            </form>
        </div>
    </header>








    <!-- JS bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- JS bootstrap sekiranya cdnnya down -->
    <script>
        if (typeof($.fn.modal) === 'undefined') {
            document.write('<script src="bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"><\/script>')
        }
    </script>

</body>

</html>