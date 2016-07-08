<?php
	echo $_POST['descrip'];
    	if(	isset($_POST['idfactura']) 	&&
    		 isset($_POST['numero']) 	&&
    		 isset($_POST['idcliente']) &&
    		 isset($_POST['fecha']) 	&&
    		 isset($_POST['idvendedor']) &&
    		 isset($_POST['descrip']))
    	{
			try {
				require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
				//include("database.php");
	    		
	    		//$pdo = Database::connect();

	    		$idfactura=trim($_POST['idfactura']);
	    		$numero=trim($_POST['numero']);
	    		$idcliente=trim($_POST['idcliente']);
	    		$fecha=trim($_POST['fecha']);
	    		$idvendedor=trim($_POST['idvendedor']);
	    		$descrip=trim($_POST['descrip']);

				//$pdo = new PDO('mysql:host=localhost;dbname=tiservicios', 'root', 'yec');

				//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql="UPDATE  y_factura SET NUMERO=:numero, IDCLIENTE=:idcliente, FECHA=:fecha, IDVENDEDOR=:idvendedor, DESCRIP=:descrip WHERE IDFACTURA=:idfactura";

	  			$stmt = $pdo->prepare($sql);
	  			$rows = $stmt->execute(array(
	  				':idfactura'=>$idfactura,
	  				':numero'=>$numero,
	  				':idcliente'=>$idcliente,
	  				':fecha'=>$fecha,
	  				':idvendedor'=>$idvendedor,
	  				':descrip'=>$descrip));
//	  			echo 'data';
				if( $rows == 1 ){
			    	echo $idfactura;
				}
			} catch(PDOException $e) {
  				echo 'Error: ' . $e->getMessage();
			}
    	}else{
    		echo "error";
    	}

?>