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
      .apip_pointer{cursor: pointer;text-decoration: unset;}
      .apip_logo{
        width: 100px;
        height: 100px;
        background-image: url(/logo.png);
        background-repeat: no-repeat;
        background-position: center;
        background-size: 90px;
        background-color: white;
      }
      .apip_scroll{
        overflow: auto;
        max-height: 110px;
        cursor: pointer;
      }
    </style>
  </head>
  <body style="background: #DBE7EE;">
    <!-- header -->
    <div class="mx-auto apip_logo mt-4 rounded-circle shadow-lg"></div>
    <!-- header end -->

    <!-- Main -->
    <div class="container" style="width:400px;max-width: 90vw;">
      <div id="section_main" class="bg-white w-100 shadow p-4 mt-3 rounded">
        <div class="h4 mb-4 text-center">Cek Harga</div>

        <div class="form-floating">
          <input onkeyup="validasi('asal')" type="text" class="form-control" id="asal" placeholder="Asal">
          <label for="asal">Asal</label>
        </div>
        <div id="list_asal" class="list-group apip_scroll"></div>

        <div class="form-floating mt-3">
          <input onkeyup="validasi('tujuan')" type="text" class="form-control" id="tujuan" placeholder="Tujuan">
          <label for="tujuan">Tujuan</label>
        </div>
        <div id="list_tujuan" class="list-group apip_scroll"></div>

        <div class="form-floating mt-3">
          <input min="1" type="number" class="form-control" id="berat" placeholder="Berat">
          <label for="berat">Berat (Kg)</label>
        </div>

        <div class="form-floating mt-3">
          <input min="1" type="number" class="form-control" id="panjang" placeholder="Panjang">
          <label for="panjang">Panjang (cm)</label>
        </div>

        <div class="form-floating mt-3">
          <input min="1" type="number" class="form-control" id="lebar" placeholder="Lebar">
          <label for="lebar">Lebar (cm)</label>
        </div>

        <div class="form-floating mt-3">
          <input min="1" type="number" class="form-control" id="tinggi" placeholder="Tinggi">
          <label for="tinggi">Tinggi (cm)</label>
        </div>



        <div id="harga" class="alert alert-success text-center alert-link mt-4 mb-0 d-none" role="alert"></div>

        <button id="tombol1" onclick="hitung()" type="button" class="btn btn-primary w-100 py-2 mb-3 mt-4">Hitung</button>
        <div class="w-100 text-center mb-2">Harga tidak mengikat, silahkan hubungi
          <a class="text-primary apip_pointer" href="https://api.whatsapp.com/send?phone=628113666411&text=Halo%20Sahabat%20Tracking..">Marketing Kami</a>
        </div>
      </div>
      <div class="mt-4 w-100 text-center text-secondary mb-3">Copyright © 2021</div>
    </div>
    <!-- Main End -->

    <script type="text/javascript">

      function validasi(x) {
        document.getElementById(x).value = document.getElementById(x).value.replace("'", "");
        document.getElementById(x).value = document.getElementById(x).value.replace('"', '');
        document.getElementById(x).value = document.getElementById(x).value.replace('&', '');
        if (document.getElementById(x).value == "" || document.getElementById(x).value == " ") {
          document.getElementById('list_'+x).className = 'list-group apip_scroll d-none';
        }
        else {
          cek(x);
        }
      }

      function cek(x) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('list_'+x).innerHTML = this.responseText;
            document.getElementById('list_'+x).className = 'list-group apip_scroll';
          }
        };
        xhttp.open("POST", "/cek.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('y='+document.getElementById(x).value+'&x='+x);
      }

      function hitung() {
        if (asal.value != '' && tujuan.value != '' && berat.value != '' && panjang.value != '' && lebar.value != '' && tinggi.value != '') {
          var xhttp2 = new XMLHttpRequest();
          xhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              harga.innerHTML = this.responseText;
              harga.className = 'alert alert-success text-center alert-link mt-4 mb-0';
            }
          };
          xhttp2.open("POST", "/hitung.php", true);
          xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp2.send('asal='+asal.value+'&tujuan='+tujuan.value+'&berat='+berat.value+'&panjang='+panjang.value+'&lebar='+lebar.value+'&tinggi='+tinggi.value);
        }
      }

      function tutup(y,x) {
        document.getElementById(x).value = y;
        document.getElementById('list_'+x).className = 'list-group apip_scroll d-none';
      }
    </script>
  </body>
</html>
