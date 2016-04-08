<?php 
  /*
  Template Name: SetSession
  */
  get_header();
?>

<?php


$accessToken = $_POST["accessToken"];
$userId = $_POST["userId"];

echo 'Hello ' . ($_POST["accessToken"]) . '!';
echo 'UserId ' . ($_POST["userId"]) . '!';

$_SESSION["accessToken"] = $accessToken;
$_SESSION["userId"] = $userId;

echo ' \n SESSION IS \n ';
  
print_r($_SESSION);

//programmatic_login('10152642142586651'); 


?>

<br>Logging In......<br>

<!-- 
<br><a href ="facebook.php">facebook</a><br>

<br><a href ="http://localhost:8080/saltwell_wordpress/">saltwell</a><br>
-->
<meta http-equiv="refresh" content="0;URL=http://www.saltwellharriers.org.uk/" /> 


