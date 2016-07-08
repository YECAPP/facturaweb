<?php

	//include("database.php");
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

	$sql="	INSERT INTO y_factura(
				TEMP,NUMERO,IDCLIENTE,FECHA,IDVENDEDOR) 
			VALUES (
				1,'000',0,NOW(),0)";

	$stmt = $pdo->prepare($sql);

	try {
		$pdo->beginTransaction(); 
     	$rows =   $stmt->execute(); 
     	echo  $pdo->lastInsertId(); 
        $pdo->commit(); 
	 } catch(PDOExecption $e) { 
	 	$pdo->rollback(); 
		echo "error"	;
	}


// //	  			echo 'data';
			// if( $rows == 1 ){
			// 	//echo $stmt->lastInserId();
			// 	echo "bien";
			// 	//$pdo->lastInsertId();
			// }
	// $sql="CALL facturaReserve(@LID)";
	

	
	// $stmt = $pdo->prepare($sql);


	// $stmt->execute();
	// $stmt->closecursor();
	// $row = $pdo->query("SELECT @LID as LID")->fetch(PDO::FETCH_ASSOC);	
	
	// if ($row) {
	// 	echo  	$row['LID'] ;
	// }else{
	// 	echo -1;
	// }
?>