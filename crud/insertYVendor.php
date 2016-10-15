<?php

    if(	isset($_POST['nombreUsr']) && 
    	isset($_POST['apellido']) && 
    	isset($_POST['user']) && 
    	isset($_POST['pwd']) && 
    	isset($_POST['idRol'])
    	){
			try {
				require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

				//include("database.php");
	    		//$pdo = Database::connect();

	    		$nombreUsr=$_POST['nombreUsr'];
	    		$apellido=$_POST['apellido'];
	    		$user=$_POST['user'];
	    		$pwd=$_POST['pwd'];
	    		$idRol=$_POST['idRol'];
	    	  		
				$sql='INSERT INTO y_user(
					nombreUsr,
					apellido,
					user,
					pwd,
					idRol) 
				VALUES (
					:nombreUsr,
					:apellido,
					:user,
					:pwd,
					:idRol
					)';

	  			$stmt = $pdo->prepare($sql);
	  			$rows = $stmt->execute(array(
	  				':nombreUsr'=>$nombreUsr,
	  				':apellido'=>$apellido,
	  				':user'=>$user,
	  				':pwd'=>$pwd,
	  				':idRol'=>$idRol
	  				));

	  			
				if( $rows == 1 ){
			    	echo 'Inserción correcta';
				}
			} catch(PDOException $e) {
  				echo 'Error: ' . $e->getMessage();
			}
    	}//if isset()

?>