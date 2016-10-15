<?php if(isset($_POST['id']) && isset($_POST['id'])!=""){
	try {
		require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
		//include("database.php");
		//$pdo = Database::connect();

		$idcliente=$_POST['id'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$email=$_POST['email'];
		$telefono=$_POST['telefono'];
		$codigo=$_POST['codigo'];

		$codpost=$_POST['codpost'];
		$cdad=$_POST['cdad'];
		$estado=$_POST['estado'];
		$codtrib=$_POST['codtrib'];
		
	
		$sql="UPDATE y_client  SET  
			NOMBRE=:nombre,
			APELLIDO=:apellido,
			EMAIL=:email,
			TELEFONO=:telefono,
			CODIGO=:codigo,
			COD_POST=:codpost,
			CDAD=:cdad,
			ESTADO=:estado,
			CODTRIB=:codtrib
		 WHERE idcliente=:idcliente";

		$stmt = $pdo->prepare($sql);
		$rows=$stmt->execute(array(	':idcliente'=>$idcliente,
									':nombre'=>$nombre,
									':apellido'=>$apellido,
									':email'=>$email,
									':telefono'=>$telefono,
									':codigo'=>$codigo,
									':codpost'=>$codpost,
									':cdad'=>$cdad,
									':estado'=>$estado,
									':codtrib'=>$codtrib
									));

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