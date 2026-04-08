<?php
	$sec = "300"; 
	header("Refresh:$sec;");	
	error_reporting("E_ALL ^ E_NOTICE");	
	$company = array('companyname' => 'PT. PERMATA VALAS UTAMA <small style="font-size:14px;"><i>Authorized Money Changer</i></small>', 
                   'address' => 'Grand Itc Permata Hijau Lt. Dasar Blok C18 No.1 <br> Jl. Arteri Permata Hijau, Jakarta Selatan <br> Phone : (021) 5366 4614 / WA : 0822 4666 7301'
                  );	
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
          LIMIT 15";
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
          LIMIT 15 OFFSET 15";
  $result2 = $conn->query($sql2);

  // Close connection manually (optional, script ends will auto-close)
  mysqli_close($conn);
?>