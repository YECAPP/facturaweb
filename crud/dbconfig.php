<?php

$servername=gethostname();

if ($servername=="ylap"){
	 $db_host = "localhost";
	 $db_name = "tiservicios";
	 $db_user = "root";
	 $db_pass = "yec";
 }
else {
	 $db_host = "localhost";
	 $db_name = "facturah_y_data";
	 $db_user = "facturah_yec";
	 $db_pass = "Yec$2016";
 }
 try{
	$pdo= new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }
?>