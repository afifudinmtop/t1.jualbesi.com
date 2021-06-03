<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Sahabat Tracking</title>
    <link rel="shortcut icon" href="/logo.ico" type="image/x-icon">
    <link rel="icon" href="/logo.ico" type="image/x-icon">
    <style>
      .apip_pointer{cursor: pointer;}
      .apip_logo{
        width: 120px;
        height: 120px;
        background-image: url(/logo.png);
        background-repeat: no-repeat;
        background-position: center;
        background-size: 110px;
        background-color: white;
      }
    </style>
  </head>
  <body style="background: #DBE7EE;">
    <!-- header -->
    <div class="mx-auto apip_logo mt-4 rounded-circle shadow-lg"></div>
    <div class="text-center h4 mt-4">
      Sahabat Tracking
    </div>
    <!-- header end -->

    <!-- Main -->
    <div class="container" style="width:400px;max-width: 90vw;">
      <div id="section_main" class="bg-white w-100 shadow p-4 mt-5 rounded">
        <div class="h4 mb-4 text-center">Import Ke Database</div>
        <button id="tombol1" onclick="comot()" type="button" class="btn btn-primary w-100 py-2 mb-3">Import</button>
        <div class="w-100 text-center mb-2">Need Help? <span class="text-primary apip_pointer">Contact Us</span></div>
      </div>
      <div class="mt-4 w-100 text-center text-secondary">Copyright © 2021</div>
    </div>
    <!-- Main End -->

    <script type="text/javascript">
      function comot() {
        tombol1.innerHTML = 'Loading Aceh ...';

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            window.location = '/import/import.php?id=1';
          }
        };
        xhttp.open("GET", "/import/reset.php", true);
        xhttp.send();
      }
    </script>
  </body>
</html>
