<?php
if(isset($_POST['line']) && isset($_POST['line'])!=""){
	try {
		
		//include("database.php");
		//$pdo = Database::connect();
		require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 


		$line=$_POST['line'];
		

		$sql="DELETE FROM  y_facturaline where line=:line";

		$stmt = $pdo->prepare($sql);
		$rows=$stmt->execute(array(	':line'=>$line));

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