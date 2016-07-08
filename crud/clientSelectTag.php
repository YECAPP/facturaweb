<?php
//if(isset($_GET['q']) ) {

    //$q=$_GET['q'];

	//include("database.php");
	
	
    //Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="IDCLIENTE, ";
    $sql.="NOMBRE ";
    $sql.="FROM y_client ";
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
    	$data.='<option value="'.$row['IDCLIENTE'].'">'.$row['NOMBRE'].'</option>';
    }

    $pdo=null;
    echo $data;
//}else{echo 'sin clientes';}
?>
