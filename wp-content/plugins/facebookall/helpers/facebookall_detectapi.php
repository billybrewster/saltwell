<?php 

echo ("1 <br>");

if (isset($_GET['apikey'])) {
   echo ("2 <br>");
  $apikey = trim($_GET['apikey']);
  $apisecret = trim($_GET['apisecret']);
  $apicred = $_GET['api_request'];
  check_api_settings($apikey, $apisecret, $apicred);
}

echo ("3 <br>");
/**
 * Check api credential settings.
 */

  function check_api_settings($apikey, $apisecret, $apicred) {
	echo ("4 <br>");
    if (isset($apikey)) {
		echo ("5 <br>");
	   $url = "https://graph.facebook.com/".$apikey."?access_token=".$apikey.'|'.$apisecret;
	         echo $url;
       if ($apicred == 'curl') {
         if (in_array('curl', get_loaded_extensions ()) AND function_exists('curl_exec')) {
           $curl = curl_init();
	       curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	       curl_setopt( $curl, CURLOPT_URL, $url );
	       curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
           $app_response = curl_exec($curl);
		   $curl_response = curl_getinfo($curl);
		   curl_close( $curl );
		   echo $curl_response;
		   echo "<br> app response <b>";
		   echo $app_response;
           $app_result = json_decode($app_response);
		   if ($curl_response['http_code'] == 200) {
             echo '<div id="apisuccess">Your API settings working perfectly. Please Save your current Settings.</div>';
		     die();
           }
		   else {
		     echo '<div id="apierror">Returned error: curl response ='.$curl_response['http_code'].' ,Facebook response=';print_r($app_response).'</div>';
		     die();
		   }
		 }
		 else {
          echo '<div id="apierror">Your '.$apicred.' settings not working try to change API Handler Settings.</div>';
		  die();
		}
      }
      else {
      echo ("<br>6 <br>");
      //$url = "wewewe";
        echo ("url is " . $url);
	
        $app_response = @file_get_contents($url);
	
	$data = json_decode(file_get_contents($url, true));
	echo ("<br> data is  :");
	print_r($data);
	
	echo ("<br>7 <br>");
		$fopen_response = $http_response_header;
		echo ("8 <br>");
		echo (" fopen response is : ");
		echo $fopen_response[0];
		echo ("<br> ");
		echo (" app_response is : ");
		echo $app_response;
		echo ("<br> ");
		
		if ($fopen_response[0] == 'HTTP/1.0 200 OK' AND !empty($fopen_response[0])) {
		echo ("9 <br>");
		  echo '<div id="apisuccess">Your API settings working perfectly. Please Save your current Settings.</div>';
		  die();
        }
		else if ($fopen_response == NULL) {
		echo ("10 <br>");
          if (!in_array('https', stream_get_wrappers())) {
	  echo ("11 <br>");
            echo '<div id="apierror">Openssl not enabled for working fopen on your server.</div>';
			die();
          }
		} 
        else if ($fopen_response[0] != 'HTTP/1.0 200 OK' AND !empty($fopen_response[0])){
	echo ("12 <br>");
          echo '<div id="apierror">Returned error: fopen response ='.$fopen_response[0].' ,Facebook response=';print_r($http_response_header).'</div>';
		  die();
        }
		else {
		echo ("10 <br>");
          echo '<div id="apierror">Your '.$apicred.' settings not working try to change API Handler Settings.</div>';
		  die();
		}
	  }
    }
  }