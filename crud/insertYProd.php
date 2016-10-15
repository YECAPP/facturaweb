<?php

    if(	isset($_POST['codigo'])	&& 
    	isset($_POST['descrip'])&& 
    	isset($_POST['marca']) 	&& 
    	isset($_POST['modelo']) && 
    	isset($_POST['costo']) 	&& 
    	isset($_POST['precio']) &&
		isset($_POST['tax']) ){
			try {
				require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

				//include("database.php");
	    		//$pdo = Database::connect();

	    		$codigo=$_POST['codigo'];
	    		$descrip=$_POST['descrip'];
	    		$marca=$_POST['marca'];
	    		$modelo=$_POST['modelo'];
	    		$costo=$_POST['costo'];
	    		$precio=$_POST['precio'];
	    	  	$tax=$_POST['tax'];

				$sql='INSERT INTO y_producto (
					codigo,
					descrip,
					marca,
					modelo,
					costo,
					precio,
					tax) 
				VALUES (
					:codigo,
					:descrip,
					:marca,
					:modelo,
					:costo,
					:precio,
					:tax
					)';

	  			$stmt = $pdo->prepare($sql);
	  			$rows = $stmt->execute(array(
	  				':codigo'=>$codigo,
	  				':descrip'=>$descrip,
	  				':marca'=>$marca,
	  				':modelo'=>$modelo,
	  				':costo'=>$costo,
	  				':precio'=>$precio,
	  				':tax'=>$tax
	  				));

	  			
				if( $rows == 1 ){
			    	echo 'Inserción correcta';
				}
			} catch(PDOException $e) {
  				echo 'Error: ' . $e->getMessage();
			}
    	}//if isset()

?>