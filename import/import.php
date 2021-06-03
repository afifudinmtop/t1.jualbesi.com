<?php
  $servername = "localhost";
  $username = "jualbes1_t1";
  $password = "Anakkeren8850!";
  $dbname = "jualbes1_t1";
  $id = $_GET['id'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql="select * from kode where id = '".$id."'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if($result->num_rows == 0) {
    header('Location: /import/index.php');
    exit;
  }

  $url = $row["url"];
  $kode = $row["kode"];
  $provinsi = $row["provinsi"];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $output = curl_exec($ch);
  curl_close($ch);
  echo '<div id="utama" class="d-none">'.$output.'</div>';
?>
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
  <body style="background: #DBE7EE;" onload="comot()">
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
        <button id="tombol1" type="button" class="btn btn-primary w-100 py-2 mb-3">Import</button>
        <div class="w-100 text-center mb-2">Need Help? <span class="text-primary apip_pointer">Contact Us</span></div>
      </div>
      <div class="mt-4 w-100 text-center text-secondary">Copyright © 2021</div>
    </div>
    <!-- Main End -->

    <script type="text/javascript">
      var kode = '<?=$kode?>';
      var provinsi = '<?=$provinsi?>';
      var id = '<?=$id?>';
      var jumlah = document.getElementsByTagName('tr').length;

      function comot() {
        tombol1.innerHTML = 'Loading '+provinsi+' ...';
        kirim(2);
      }

      function kirim(x) {
        if (x < jumlah) {
          var value0 = document.getElementsByTagName('tr')[x].getElementsByTagName('td')[0].innerText;
          var value1 = document.getElementsByTagName('tr')[x].getElementsByTagName('td')[1].innerText;
          var value2 = document.getElementsByTagName('tr')[x].getElementsByTagName('td')[2].innerText;
          var value3 = document.getElementsByTagName('tr')[x].getElementsByTagName('td')[3].innerText;
          var value4 = document.getElementsByTagName('tr')[x].getElementsByTagName('td')[4].innerText;
          var value5 = document.getElementsByTagName('tr')[x].getElementsByTagName('td')[5].innerText;

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var persen = Math.round((x*100/jumlah));
              tombol1.innerHTML = 'Loading '+provinsi+' '+persen+'% ...';
              x++;
              kirim(x);
            }
          };
          xhttp.open("POST", "/import/comot.php", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send('value0='+value0+'&value1='+value1+'&value2='+value2+'&value3='+value3+'&value4='+value4+'&value5='+value5);
        }
        else {
          id++;
          window.location = '/import/import.php?id='+id;
        }
      }
    </script>
  </body>
</html>
