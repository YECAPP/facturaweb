<?php
//if(isset($_GET['q']) ) {

    //$q=$_GET['q'];

	//include("database.php");
	
	
    //Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="DESCRIP, ";
    $sql.="VALOR ";
    $sql.="FROM y_param ";
    $sql.="WHERE TP=1 ";
    
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
    	$data.='<option value="'.$row['VALOR'].'">'.$row['DESCRIP'].'('.$row['VALOR'].'%)'.'</option>';
    }

    $pdo=null;
    echo $data;
//}else{echo 'sin clientes';}
?>
