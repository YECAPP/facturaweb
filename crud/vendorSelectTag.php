<?php
//if(isset($_GET['q']) ) {

    //$q=$_GET['q'];

	//include("database.php");
	
	
    //Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="idRol, ";
    $sql.="nombreRol ";
    $sql.="FROM y_rol ";
    
    $data="";

    //if (empty($q)){
    //    $sql.=" ";    
    //}else{
     //   $sql.=" WHERE   NOMBRE like '%".$q."%'";
    //}
    
    //$data.=$sql;
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

    foreach ($pdo->query($sql) as $row) 
    {	
    	$data.='<option value="'.$row['idRol'].'">'.$row['nombreRol'].'</option>';
    }

    $pdo=null;
    echo $data;
//}else{echo 'sin clientes';}
?>
