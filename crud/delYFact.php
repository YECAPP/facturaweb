<?php
if(isset($_POST['idfactura']) && isset($_POST['idfactura'])!=""){
	try {
		
		//include("database.php");
		//$pdo = Database::connect();
		require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

		$idfactura=$_POST['idfactura'];
		
		$sql="DELETE FROM  y_factura where idfactura=:idfactura;
		DELETE FROM  y_facturaline where idfactura=:idfactura;";

		$stmt = $pdo->prepare($sql);
		$rows=$stmt->execute(array(	':idfactura'=>$idfactura));

		$response = array();

		if( $rows > 0 ){
			$response['message']="ok";
		}
		else
		{
			$response['status']=200;
			$response['message']="nothing";
		}

		echo json_encode($response);

	} catch(PDOException $e) {
  		echo 'Error: ' . $e->getMessage();
	}
}//if isset()
?>