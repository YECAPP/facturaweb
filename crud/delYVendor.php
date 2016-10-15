<?php
if(isset($_POST['id']) && isset($_POST['id'])!=""){
	try {
		
		//include("database.php");
		//$pdo = Database::connect();
		require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

		$idUser=$_POST['id'];
		
		$sql="DELETE FROM  y_user  where idUser=:idUser";

		$stmt = $pdo->prepare($sql);
		$rows=$stmt->execute(array(	':idUser'=>$idUser));

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