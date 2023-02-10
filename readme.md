# Branch main untuk projek utama dan branch base adalah gambaran dari logika yang telah dibuat

# **</-- JIKA INGIN MENJALANKAN PROJECT YANG DI BRANCH BASE DOWNLOAD TERLEBIH DAHULU FILE school.sql DAN IMPORT DI PHPMYADMIN --/**

### (anak anak front end): untuk CDN Bootstrap bisa copy di bawah ini

````
Di taruh di head

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
    </script>```

    ```
    di taruh di body bawah

    <!-- JS bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- JS bootstrap sekiranya cdnnya down -->
    <script>
        if (typeof($.fn.modal) === 'undefined') {
            document.write('<script src="bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"><\/script>')
        }
    </script>

    ```
````

# jangan ngoprek direktori yang udah ada, kalau mau ijin dulu dan di pastiin ga bikin rusak. Meminta ijin kepada yang contributor / lord Gin Gin

# Semangat!
