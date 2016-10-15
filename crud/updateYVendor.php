<?php
if(isset($_POST['id'])||isset($_POST[id])!=""){
	require_once 'dbconfig.php';
	$idUser=$_POST['id']; 

	$nombreUsr=$_POST['nombreUsr'];
	$apellido=$_POST['apellido'];
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	$idRol=$_POST['idRol'];

	$sql='UPDATE y_user SET 
		nombreUsr=:nombreUsr,
		apellido=:apellido,
		user=:user,
		pwd=:pwd,
		idRol=:idRol
		WHERE idUser=:idUser';
	
	$stmt=$pdo->prepare($sql);
	
	$rows=$stmt->execute(array(
		':nombreUsr'=>$nombreUsr,
		':apellido'=>$apellido,
		':user'=>$user,
		':pwd'=>$pwd,
		':idRol'=>$idRol,
		':idUser'=>$idUser));

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