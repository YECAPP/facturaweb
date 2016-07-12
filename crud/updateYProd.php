<?php
if(isset($_POST['id'])||isset($_POST[id])!=""){
	require_once 'dbconfig.php';
	$idproducto=$_POST['id']; 

	$descrip=$_POST['descrip'];
	$marca=$_POST['marca'];
	$modelo=$_POST['modelo'];
	$costo=$_POST['costo'];
	$precio=$_POST['precio'];

	$sql='UPDATE y_producto SET 
		DESCRIP=:descrip,
		MARCA=:marca,
		MODELO=:modelo,
		COSTO=:costo,
		PRECIO=:precio
		WHERE idproducto=:idproducto';
	
	$stmt=$pdo->prepare($sql);
	
	$rows=$stmt->execute(array(
		':descrip'=>$descrip,
		':marca'=>$marca,
		':modelo'=>$modelo,
		':costo'=>$costo,
		':precio'=>$precio,
		':idproducto'=>$idproducto));

	$respones=array();

	if ($rows>0){
		$response['message']="ok";
	}else{
		$response['status']=200;
		$response['message']="nothing";
	}

	echo json_encode($response);

}else{
	echo "Unset Variable Id ";
}

?>