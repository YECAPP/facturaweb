<?php
    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email'])){
		try {
			require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

			$nombre=$_POST['nombre'];
			$apellido=$_POST['apellido'];
			$email=$_POST['email'];
			$telefono=$_POST['telefono'];
			$codigo=$_POST['codigo'];

			$codpost=$_POST['codpost'];
			$cdad=$_POST['cdad'];
			$direcc=$_POST['direcc'];
			$estado=$_POST['estado'];
			$codtrib=$_POST['codtrib'];

		    
			//$pdo = new PDO('mysql:host=localhost;dbname=tiservicios', 'root', 'yec');


			//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 $sql='INSERT INTO y_client 
			 		(nombre, apellido,  email, telefono, codigo, cod_post, cdad, direcc, estado, codtrib) 
			 VALUES (:nombre,:apellido,:email,:telefono,:codigo,:cod_post,:cdad,:direcc,:estado,:codtrib)';


			$stmt = $pdo->prepare($sql);
			$rows = $stmt->execute(array(
				':nombre'=>$nombre,
			 	':apellido'=>$apellido,
			 	':email'=>$email,
			 	':telefono'=>$telefono,
			 	':codigo'=>$codigo,
			 	':cod_post'=>$codpost,
			 	':cdad'=>$cdad,
			 	':direcc'=>$direcc,
			 	':estado'=>$estado,
			 	':codtrib'=>$codtrib
			 	));

			$response = array();

			if( $rows == 1 ){
		    	$response['message']="ok";
			}else{
				$response['status']=200;
				$response['message']="nothing";
			}

			echo json_encode($response);

		} catch(PDOException $e) {
				echo 'Error: ' . $e->getMessage();
		}
    }//if isset()

?>