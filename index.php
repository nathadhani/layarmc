<?php
	$sec = "300"; 
	header("Refresh:$sec;");	
	error_reporting("E_ALL ^ E_NOTICE");	
	$company = array('companyname' => 'PT. PERMATA VALAS UTAMA', 
                   'address' => 'Grand Itc Permata Hijau Lt. Dasar Blok C18 No.1 <br> Jl. Arteri Permata Hijau, Jakarta Selatan | (021) 5366 4614 / WA : 0822 4666 7301'
                  );		
?>
<?php
  $servername = "localhost";
  $username = "root";
  $password = "vunrtmry007";
  $dbname = "dbepos";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully";

  $today = DATE('Y-m-d');
  $sql1 = "SELECT m_currency.currency_code,
                1 AS denomination,
                m_exchange_rate.exchange_rate_buy,
                m_exchange_rate.exchange_rate_sell
          FROM m_exchange_rate 
          JOIN m_currency ON m_currency.id = m_exchange_rate.currency_id
          WHERE m_exchange_rate.exchange_rate_date = '$today'
          AND m_exchange_rate.store_id = 6          
          GROUP BY m_currency.currency_code
          HAVING m_exchange_rate.exchange_rate_buy > 0 AND m_exchange_rate.exchange_rate_sell > 0
          ORDER BY m_currency.currency_code ASC
          LIMIT 13";
  $result1 = $conn->query($sql1); 

  $sql2 = "SELECT m_currency.currency_code,
                1 AS denomination,
                m_exchange_rate.exchange_rate_buy,
                m_exchange_rate.exchange_rate_sell
          FROM m_exchange_rate 
          JOIN m_currency ON m_currency.id = m_exchange_rate.currency_id
          WHERE m_exchange_rate.exchange_rate_date = '$today'
          AND m_exchange_rate.store_id = 6          
          GROUP BY m_currency.currency_code
          HAVING m_exchange_rate.exchange_rate_buy > 0 AND m_exchange_rate.exchange_rate_sell > 0
          ORDER BY m_currency.currency_code ASC
          LIMIT 13 OFFSET 13";
  $result2 = $conn->query($sql2);

  // Close connection manually (optional, script ends will auto-close)
  mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kurs Permata Valas Utama</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logopermata.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->  
  <link href="assets/css/style.css" rel="stylesheet"> 
</head>

<body onLoad="setInterval('displayServerTime()', 1000);" oncontextmenu="return false">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <strong><span style="text-align:left;font-size:22px;font-weight:bold;font-name:arial-black;color:#000"><?=$company["companyname"]?></span></strong>
    <nav class="header-nav ms-auto">      
      <span style="text-align:right;font-size:22px;font-weight:bold;font-name:arial-black;color:#000;margin-right:25px;">
          <?php
              function dayList(){
                $date = date('Y-m-d');
                $day = date('D', strtotime($date));
                $hari = array(
                      'Sun' => 'Minggu',
                    'Mon' => 'Senin',
                    'Tue' => 'Selasa',
                    'Wed' => 'Rabu',
                    'Thu' => 'Kamis',
                    'Fri' => 'Jumat',
                    'Sat' => 'Sabtu'
                );
                return $hari[$day];
            }
            echo dayList(). ', ' . date('d F Y');
          ?>  
          - <span id="clock" style="font-weight:bold;font-name:arial-black;color:black;"><?php print date('H:i:s');?></span>
        </span>
    </nav><!-- End Icons Navigation -->
  </header>
  <!-- End Header --> 

  <main id="main" class="main">
    <!-- startrow -->
    <div class="row">

      <!-- panelkurs -->
      <div class="col-lg-3">
        <!-- startkurs -->
        <table id="table1" style="margin-top:-2px">
            <thead>
              <tr>
                <th>Currency</th>
                <th>We BUY</th>
                <th>We SELL</th>
              </tr>
            </thead>
            <tbody>
              <?php                        
                if ($result1->num_rows > 0) {         
                  $no = 1;
                  while($row = $result1->fetch_assoc()) {
              ?>    
                <tr>
                  <td><?=$row['currency_code']?></td>
                  <?php if (fmod($row['exchange_rate_buy'], 1) != 0)  { ?>
                    <td><?=$row['exchange_rate_buy'] <> 0 ? number_format($row['exchange_rate_buy'],3) : '-' ?></td>
                  <?php } else { ?>
                    <td><?=$row['exchange_rate_buy'] <> 0 ? number_format($row['exchange_rate_buy'],0) : '-' ?></td>
                  <?php } ?>

                  <?php if (fmod($row['exchange_rate_sell'], 1) != 0)  { ?>
                    <td><?=$row['exchange_rate_sell'] <> 0 ? number_format($row['exchange_rate_sell'],3) : '-' ?></td>
                  <?php } else { ?>
                    <td><?=$row['exchange_rate_sell'] <> 0 ? number_format($row['exchange_rate_sell'],0) : '-' ?></td>
                  <?php } ?>
                </tr>
              <?php
                      $no++;     
                  }
                }
              ?>
            </tbody>
          </table> 
          <!-- endkurs -->
      </div>

      <div class="col-lg-3">
        <!-- startkurs -->
        <table id="table2" style="margin-top:-2px">
            <thead>
              <tr>
                <th>Currency</th>
                <th>We BUY</th>
                <th>We SELL</th>
              </tr>
            </thead>
            <tbody>
              <?php                        
                if ($result2->num_rows > 0) {     
                  $no = 1;
                  while($row = $result2->fetch_assoc()) {
              ?>    
                <tr>
                  <td><?=$row['currency_code']?></td>
                  <?php if (fmod($row['exchange_rate_buy'], 1) != 0)  { ?>
                    <td><?=$row['exchange_rate_buy'] <> 0 ? number_format($row['exchange_rate_buy'],3) : '-' ?></td>
                  <?php } else { ?>
                    <td><?=$row['exchange_rate_buy'] <> 0 ? number_format($row['exchange_rate_buy'],0) : '-' ?></td>
                  <?php } ?>

                  <?php if (fmod($row['exchange_rate_sell'], 1) != 0)  { ?>
                    <td><?=$row['exchange_rate_sell'] <> 0 ? number_format($row['exchange_rate_sell'],3) : '-' ?></td>
                  <?php } else { ?>
                    <td><?=$row['exchange_rate_sell'] <> 0 ? number_format($row['exchange_rate_sell'],0) : '-' ?></td>
                  <?php } ?>
                </tr>
              <?php
                      $no++;    
                  }
                }
              ?>
            </tbody>
          </table> 
          <!-- endkurs -->
      </div>
      <!-- endpanelkurs -->

      <!-- panelvideo -->
      <div class="col-lg-6">
        <!-- startcardvideo -->
         <div class="row">
          <video controls id="myVideo" autoplay muted loop>
            <source src="video.mp4" type="video/mp4"/>
          </video>
        </div>
        <!-- endcardvideo -->
        <div class="row">
            <!-- <div class="col-mb-12"> -->
              <!-- <div class="card mb-12"> -->
                <div class="card">
                  	<p>
                      <strong><span style="font-size:20px;">Jam Operasional :</span></strong>
                      <br>
                      Senin - Jum'at ( 8AM - 7PM ) <br>
                      Sabtu - Minggu ( 10AM - 7PM ) <br>                      
                      <?=$company["address"]?>
                    </p>
                </div>
              <!-- </div>
            </div> -->
        </div>
      </div>
      <!-- endpanelvideo -->       
       
    </div>
    <!-- endrow -->
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer fixed-bottom d-flex align-items-center">
    Note : Harga dan stock dapat berubah sewaktu - waktu, Mohon konfirmasi kembali setelah deal. Terima Kasih
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script type="text/javascript">
    //set timezone
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    //buat object date berdasarkan waktu di server
    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
    //buat object date berdasarkan waktu di client
    var clientTime = new Date();
    //hitung selisih
    var Diff = serverTime.getTime() - clientTime.getTime();    
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayServerTime(){
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //buat object date dengan menghitung selisih waktu client dan server
        var time = new Date(clientTime.getTime() + Diff);
        //ambil nilai jam
        var sh = time.getHours().toString();
        //ambil nilai menit
        var sm = time.getMinutes().toString();
        //ambil nilai detik
        var ss = time.getSeconds().toString();
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
    <?php
        $tanggal = date('Y-m-d');
        $day = date('D', strtotime($tanggal));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
        $dayList2 = array(
            'Sun' => 'Sunday',
            'Mon' => 'Monday',
            'Tue' => 'Tuesday',
            'Wed' => 'Wednesday',
            'Thu' => 'Thursday',
            'Fri' => 'Friday',
            'Sat' => 'Saturday'
        );
    ?>
  </script>

  <script type="text/javascript">
    $(document).bind("contextmenu",function(e) {
     e.preventDefault();
    });
    
    $(document).keydown(function(e){
      if(e.which === 123){
          return false;
      }
    });
    
    document.onkeydown = function(e) {
      if (e.ctrlKey && 
        (e.keyCode === 67 || 
          e.keyCode === 86 || 
          e.keyCode === 85 || 
          e.keyCode === 117)) {
        return false;
      } else {
        return true;
      }
    };
    $(document).keypress("u",function(e) {
      if(e.ctrlKey)
      {
      return false;
      }
      else
      {
      return true;
      }
    });
  </script>

</body>

</html>