
<?php
		//echo "<script>alert(".$_POST['idfactura'].")</script>";
				//include("database.php");
	require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

	//$pdo = Database::connect();

	$idfactura=$_POST['idfactura'];
	$idproducto=$_POST['idproducto'];
	$cantidad=$_POST['cantidad'];
	
	//$pdo = new PDO('mysql:host=localhost;dbname=tiservicios', 'root', 'yec');

	//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql='INSERT INTO y_facturaline (idfactura,idproducto, cantidad) VALUES (:idfactura, :idproducto, :cantidad)';

		$stmt = $pdo->prepare($sql);
		$rows = $stmt->execute(array(':idfactura'=>$idfactura,':idproducto'=>$idproducto,':cantidad'=>$cantidad));
	//	  			echo 'data';
	if( $rows == 1 ){
		echo $idfactura;

	}
			

?>