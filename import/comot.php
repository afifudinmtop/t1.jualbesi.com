<?php
  $servername = "localhost";
  $username = "jualbes1_t1";
  $password = "Anakkeren8850!";
  $dbname = "jualbes1_t1";

  $no = $_POST['value0'];
  $kecamatan = $_POST['value1'];
  $kota = $_POST['value2'];
  $provinsi = $_POST['value3'];
  $gabungan = $_POST['value4'];
  $kode = $_POST['value5'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "insert into kecamatan (no, kecamatan, kota, provinsi, gabungan, kode) values ('".$no."', '".$kecamatan."', '".$kota."', '".$provinsi."', '".$gabungan."', '".$kode."')";
  $rs = mysqli_query($conn, $sql);

  echo "ok";
?>
