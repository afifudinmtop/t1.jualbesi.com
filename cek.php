<?php
  $x = $_POST['x'];
  $y = $_POST['y'];

  $servername = "localhost";
  $username = "jualbes1_t1";
  $password = "Anakkeren8850!";
  $dbname = "jualbes1_t1";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $cetak = '';

  $sql = "select * from kecamatan where gabungan like '%".$y."%' order by id desc limit 20";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $gabungan = $row["gabungan"];
      $cetak = $cetak.'<a onclick="tutup(this.innerText,'."'".$x."'".')" class="list-group-item list-group-item-action">'.$gabungan.'</a>';
    }
  }
  echo $cetak;
?>
