<?php

$servername=gethostname();
switch ($servername){
case "ylap":
	 $db_host = "localhost";
	 $db_name = "tiservicios";
	 $db_user = "root";
	 $db_pass = "yec";
	 $db_port="3306";
	 break;
case "NY1ZYGBTISERV01":
	 $db_host = "localhost";
	 $db_name = "yec17sitio";
	 $db_user = "yec17sitiousr";
	 $db_pass = "Clave.2016.sitio";
	 $db_port="3306";
	break;
default:
	 $db_host = "mysql365int.srv-hostalia.com";
	 $db_name = "db4148864_dbyecftw";
	 $db_user = "u4148864_ftw";
	 $db_pass = "UgEDd5gbT)Fi#w+:";
	 $db_port="3306";
	 break;
}	

 try{
	$pdo= new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8;port={$db_port}",$db_user,$db_pass);
  	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }
?>