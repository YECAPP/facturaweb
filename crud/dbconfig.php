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
	 $db_name = "yec17sitio";
	 $db_user = "yec17sitiousr";
	 $db_pass = "Clave.2016.sitio";
 }
 try{
	$pdo= new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }
?>