<?php
	require_once '../crud/dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 		
		//include("database.php");
		//$pdo = Database::connect();

	
		$sql="SELECT * FROM y_producto order by costo limit 5";

		$stmt = $pdo->prepare($sql);
		$rows=$stmt->execute();
		$response = array();

		$pdo->query("SET NAMES utf8");

		$data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($data);

		//echo json_encode($response);

?>