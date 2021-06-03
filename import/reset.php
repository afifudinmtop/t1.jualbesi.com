<?php
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

  $sql = "truncate table kecamatan";
  $rs = mysqli_query($conn, $sql);

  echo "ok";
?>
