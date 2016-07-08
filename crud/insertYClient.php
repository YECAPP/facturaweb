<?php
    	if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email'])){
			try {
				require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

				//include("database.php");
	    		//$pdo = Database::connect();

	    		$nombre=$_POST['nombre'];
	    		$apellido=$_POST['apellido'];
	    		$email=$_POST['email'];
	    	    
				//$pdo = new PDO('mysql:host=localhost;dbname=tiservicios', 'root', 'yec');


				//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql='INSERT INTO y_client (nombre, apellido, email) VALUES (:nombre, :apellido, :email)';

	  			$stmt = $pdo->prepare($sql);
	  			$rows = $stmt->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':email'=>$email));
	  			echo 'data';
				if( $rows == 1 ){
			    	echo 'Inserción correcta';
				}
			} catch(PDOException $e) {
  				echo 'Error: ' . $e->getMessage();
			}
    	}//if isset()

?>