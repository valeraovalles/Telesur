<?php
	
    $url = "http://localhost/Sis_Pauta/login.php";


      $handler = curl_init();

     curl_setopt($handler, CURLOPT_URL, $url);

     curl_setopt($handler, CURLOPT_POST,true);

       curl_setopt($handler, CURLOPT_POSTFIELDS, "login=".$_GET['u']."&password=".str_replace("qwerty","#",$_GET['c'])."");

  

      $response = curl_exec ($handler);

      curl_close($handler);
?>
