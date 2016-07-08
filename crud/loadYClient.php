<?php
if(isset($_POST['id']) && isset($_POST['id'])!=""){
	try {
		require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 		
		//include("database.php");
		//$pdo = Database::connect();

		$idcliente=$_POST['id'];

		$sql="SELECT * FROM y_client where idcliente=:idcliente";

		$stmt = $pdo->prepare($sql);
		$rows=$stmt->execute(array(':idcliente'=>$idcliente));

		$response = array();

		if( $rows > 0 ){
			while($row=$stmt->fetch()){
				$response=$row; 
			}
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
else
{
	$response['status']=200;
	$response['message']="invalid request";
}
?>