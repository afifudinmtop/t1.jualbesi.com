<?php
  $asal = $_POST['asal'];
  $tujuan = $_POST['tujuan'];
  $berat = $_POST['berat'];
  $panjang = $_POST['panjang'];
  $lebar = $_POST['lebar'];
  $tinggi = $_POST['tinggi'];
  $dimensi = $panjang*$lebar*$tinggi;

  $servername = "localhost";
  $username = "jualbes1_t1";
  $password = "Anakkeren8850!";
  $dbname = "jualbes1_t1";

  $harga = 0;
  $cetak = '';

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }


  $sql = "select * from kecamatan where gabungan like '%".$asal."%' order by id desc limit 1";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $asal_kode = $row["kode"];
    }
  }


  $sql2 = "select * from kecamatan where gabungan like '%".$tujuan."%' order by id desc limit 1";
  $result2 = $conn->query($sql2);

  if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
      $tujuan_kode = $row2["kode"];
    }
  }





  $asal_separator = strpos($asal_kode, "_");
  $asal_kode_x1 = substr($asal_kode,0,$asal_separator);
  $asal_kode_x2 = substr($asal_kode,$asal_separator+1);

  $tujuan_separator = strpos($tujuan_kode, "_");
  $tujuan_kode_x1 = substr($tujuan_kode,0,$tujuan_separator);
  $tujuan_kode_x2 = substr($tujuan_kode,$tujuan_separator+1);





  if ($asal_kode == $asal_tujuan) {
    $harga_berat_kg = 1000;
    $harga_dimensi_m3 = 100000;
    $delivery = "2-3 Hari";
  }
  elseif ($asal_kode_x1 == $tujuan_kode_x1) {
    $delivery = "3-4 Hari";

    $harga_berat_kg = 2000;
    $harga_berat_kg_add = abs($asal_kode_x2 - $tujuan_kode_x2);
    $harga_berat_kg_add = $harga_berat_kg_add*100;
    $harga_berat_kg = $harga_berat_kg + $harga_berat_kg_add;

    $harga_dimensi_m3 = 200000;
    $harga_dimensi_m3_add = abs($asal_kode_x2 - $tujuan_kode_x2);
    $harga_dimensi_m3_add = $harga_dimensi_m3_add*10000;
    $harga_dimensi_m3 = $harga_dimensi_m3 + $harga_dimensi_m3_add;
  }
  else {
    $delivery = "5-7 Hari";
    $harga_berat_kg_add = abs($asal_kode_x1 - $tujuan_kode_x1);
    $harga_berat_kg = ($harga_berat_kg_add*1000)+1000;

    $harga_dimensi_m3_add = abs($asal_kode_x1 - $tujuan_kode_x1);
    $harga_dimensi_m3 = ($harga_dimensi_m3_add*100000)+100000;
  }
  $minimum_harga_ori = 40*$harga_berat_kg;
  $harga_berat_ori = $harga_berat_kg*$berat;
  $harga_dimensi_ori = $harga_dimensi_m3*($dimensi/1000000);


  $harga_berat = number_format($harga_berat_kg*$berat);
  $harga_dimensi = number_format($harga_dimensi_m3*($dimensi/1000000));

  $harga_berat_kg = number_format($harga_berat_kg);
  $harga_dimensi_m3 = number_format($harga_dimensi_m3);

  $berat = number_format($berat);
  $dimensi = number_format($dimensi);
  $minimum_harga = number_format($minimum_harga_ori);

  if ($harga_berat_ori > $harga_dimensi_ori) {
    $harga = $harga_berat_ori;
    $dasar = 'Berat';
  }
  // else {
  //   $harga = $harga_dimensi_ori;
  //   $dasar = 'Volume';
  // }

  if ($harga < $minimum_harga_ori) {
    $harga = $minimum_harga_ori;
    $dasar = 'Minimum Biaya';
  }
  $harga = number_format($harga);


  $cetak = $cetak.'<h1>Rp '.$harga.'</h1>';
  $cetak = $cetak.'<h5 class="mt-4">Detail</h5>';
  $cetak = $cetak.'<ul class="list-group">';

  $cetak = $cetak.'<li class="list-group-item mb-3">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Asal</h6>';
  $cetak = $cetak.'<small class="text-muted">'.$asal.'</small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'<li class="list-group-item mb-3">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Tujuan</h6>';
  $cetak = $cetak.'<small class="text-muted">'.$tujuan.'</small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'<li class="list-group-item mb-3">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Berat</h6>';
  $cetak = $cetak.'<small class="text-muted">'.$berat.' Kg</small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'<li class="list-group-item mb-3 d-none">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Volume</h6>';
  $cetak = $cetak.'<small class="text-muted">'.$dimensi.' cm<sup>3</sup></small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'<li class="list-group-item mb-3">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Harga/Kg</h6>';
  $cetak = $cetak.'<small class="text-muted">Rp '.$harga_berat_kg.'</small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'<li class="list-group-item mb-3">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Harga/m<sup>3</sup></h6>';
  $cetak = $cetak.'<small class="text-muted">Rp '.$harga_dimensi_m3.'</small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'<li class="list-group-item mb-3">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Minimum Berat</h6>';
  $cetak = $cetak.'<small class="text-muted">40 Kg</small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'<li class="list-group-item mb-3">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Delivery</h6>';
  $cetak = $cetak.'<small class="text-muted">'.$delivery.'</small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'<li class="list-group-item mb-3">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Minimum Biaya</h6>';
  $cetak = $cetak.'<small class="text-muted">Rp '.$minimum_harga.'</small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'<li class="list-group-item mb-3">';
  $cetak = $cetak.'<div>';
  $cetak = $cetak.'<h6 class="my-0">Biaya Berdasarkan</h6>';
  $cetak = $cetak.'<small class="text-muted">'.$dasar.'</small>';
  $cetak = $cetak.'</div>';
  $cetak = $cetak.'</li>';

  $cetak = $cetak.'</ul>';

  echo $cetak;
?>
