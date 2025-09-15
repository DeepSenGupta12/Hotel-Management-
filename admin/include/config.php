<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//date_default_timezone_get('Asia/Kolkata');
try {
  $mysqli = new mysqli("localhost", "root","","indrapuri");
  //mysqli_query($mysqli,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
  //mysqli_set_charset($mysqli,'utf8');
} catch(Exception $e) {
  error_log($e->getMessage());
  exit('Error connecting to database'); //Should be a message a typical user could understand
}
$title = "ADMIN PANEL OF HOTEL";
$sitetitle = "INDRAPURI HOTEL & RESORT PVT. LTD.";
$sitelink = "http://localhost/indrapurihotel";
$link = $sitelink."/admin";


?>