<?php
	session_start();
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
    
//generar correlativo automatico 
    $idvendor=$_SESSION['idUser_session'];
    $sqlMaxNum="SELECT MAX(CAST(NUMERO as signed)) as NUM FROM y_factura WHERE IDVENDEDOR=".$idvendor;

    $rowMaxNum = $pdo->query($sqlMaxNum);
	$maxNumArray=$rowMaxNum->fetch();

	$idMaxNum=$maxNumArray["NUM"];

	$idMaxNumNew=intval($idMaxNum+1);



//reservando factura 
    $lastInsertId=-1;
	$sql="	INSERT INTO y_factura(
				TEMP,NUMERO,IDCLIENTE,FECHA,IDVENDEDOR) 
			VALUES (
				1,:idMaxNumNew,0,NOW(),:idvendedor)";

	$stmt = $pdo->prepare($sql);
	

	try {
		//$pdo->beginTransaction(); 
     	//$stmt->bindParam(':idMaxNumNew',$idMaxNumNew);
     	//$stmt->bindParam(':idvendedor',$idvendor);
     	
     	//$rows = $stmt->execute(); 
		$rows = $stmt->execute(array(
				':idMaxNumNew'=>$idMaxNumNew,
	  			':idvendedor'=>$idvendor)); 

     	$lastInsertId =$pdo->lastInsertId(); 
        //$pdo->commit(); 

        //$arr = array('lastInsertId' => $lastInsertId, 'numero' => $idMaxNumNew);
        $arr = array($lastInsertId,$idMaxNumNew,$idvendor);
		echo json_encode($arr);

        //echo $lastInsertId;
	 } catch(PDOExecption $e) { 
	 	//$pdo->rollback(); 
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