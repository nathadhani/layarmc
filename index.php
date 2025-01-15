<?php
	$sec = "300"; 
	header("Refresh:$sec;");	
	error_reporting("E_ALL ^ E_NOTICE");	
	$company = array('companyname' => 'PT. PERMATA VALAS UTAMA', 
                   'address' => 'Grand Itc Permata Hijau Lt. Dasar Blok C18 No.1 <br> Jl. Arteri Permata Hijau, Jakarta Selatan | (021) 5366 4614 / WA : 0822 4666 7301'
                  );		
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
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
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <!-- <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet"> -->

  <link href="assets/css/datatables/bootstrap.css" rel="stylesheet">
  <link href="assets/css/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->  
  <link href="assets/css/style_dashboard.css" rel="stylesheet"> 
</head>

<body onLoad="setInterval('displayServerTime()', 1000);">

  <!-- ======= Header ======= -->
  <!-- <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logopermata.png" alt="">
        <span class="d-none d-lg-block"><?=$company["companyname"]?></span>
        <span class="d-none d-lg-block">Jam Operasional : Senin - Jum'at ( 8AM - 7PM) | Sabtu - Minggu ( 10AM - 7PM)</span>
      </a>      
    </div>
    <nav class="header-right ms-auto">
      
    </nav>
  </header> -->
  <!-- End Header --> 

  <main id="main" class="main">
    
    <section class="section">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <div class="col-mb-12">
              <div class="card">
                <!-- <div class="card-body"> -->
                  <video controls id="myVideo" autoplay muted loop>
                    <source src="video.mp4" type="video/mp4"/>
                  </video>
                <!-- </div> -->
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-mb-12">
                <div class="card mb-3">
                  <div class="row g-0">
                      <div class="col-md-6">
                        <!-- <img src="assets/img/images.jpg" class="img-fluid rounded-start" alt="..."> -->
                        <div class="card-body">
                          <p>
                            <strong><span style="font-size:20px;"><?=$company["companyname"]?></span></strong>
                            <br>
                            <?=$company["address"]?>
                          </p>
                        </div>                          
                      </div>
                      <div class="col-md-6">
                        <div class="card-body">                          
                          <p>
                            <strong><span style="font-size:20px;">Jam Operasional :</span></strong>
                            <br>
                            Senin - Jum'at ( 8AM - 7PM) <br>
                            Sabtu - Minggu ( 10AM - 7PM)
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>            
                </div>
            </div>            
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
          <!-- Top Selling -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">       
                <h5 class="card-title">
                  <span style="text-align:right;font-weight:bold;font-name:arial-black;color:#000;">
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
                    - <span id="clock" style="font-weight:bold;font-name:arial-black;color:#d62d20;"><?php print date('H:i:s');?></span>
                  </span>
                </h5>         
                <table id="main-table" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>                    
                      <th style="text-align:center;">#</th>
                      <th>Currency</th>
                      <th>Buy</th>
                      <th>Sale</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php		
                        $txt_file = file_get_contents('file/currency.txt');
                        $rows     = explode("\n", $txt_file);
                        array_shift($rows);
                        
                        $no = 1;
                        foreach($rows as $row => $data) {
                          $row_data = explode('^', $data);                    
                          $info[$row]['CURRENCY'] = $row_data[0];
                          $info[$row]['BUY']      = $row_data[1];
                          $info[$row]['SALE']     = $row_data[2];
                          // if($no <= 10){
                      ?>    
                            <tr>
                              <td style="text-align:center;"><?=$no?></td>
                              <td><?=$info[$row]['CURRENCY']?></td>  
                              <td style="color:blue;"><?=$info[$row]['BUY']?></td> 
                              <td style="color:red;"><?= $info[$row]['SALE']?></td>
                            </tr>                         
                      <?php  
                          // }
                          $no++; 
                        } 
                        fclose($txt_file);
                      ?>
                  </tbody>
                </table>                
              </div>
            </div>            
          </div><!-- End Top Selling -->          
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <!-- <footer id="footer" class="footer">
    <div class="copyright">
      <strong><span style="font-size:20px;"><?=$company["companyname"]?></span></strong>
    </div>
    <div class="credits">
      <span style="font-size:15px;">        
        <?=$company["address"]?>
      </span>      
    </div>
  </footer> -->
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  
  <!-- <script src="assets/vendor/simple-datatables/simple-datatables.js"></script> -->
  <script src="assets/js/datatables/jquery-3.7.1.js"></script>
  <script src="assets/js/datatables/popper.min.js"></script>
  <script src="assets/js/datatables/bootstrap.min.js"></script>
  <script src="assets/js/datatables/dataTables.js"></script>
  <script src="assets/js/datatables/dataTables.bootstrap4.js"></script>

  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

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
    $(document).ready( function () {
      var table = $('#main-table').DataTable( {
        bLengthChange : false,
        bInfo : false,
        pageLength : 10,
        lengthMenu: [[10, -1], [10, 'Todos']]
      } )
    } );
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