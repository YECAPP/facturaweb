<?php

	//include("database.php");
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 


	$sql="CALL facturaReserve(@LID)";
	
	//$pdo = Database::connect();
	
	$stmt = $pdo->prepare($sql);

	//$result=0;
	//$stmt->bindParam(1, $result, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);

	$stmt->execute();
	$stmt->closecursor();
	$row = $pdo->query("SELECT @LID as LID")->fetch(PDO::FETCH_ASSOC);	
	
	if ($row) {
		echo  	$row['LID'] ;
	}else{
		echo -1;
	}

?>