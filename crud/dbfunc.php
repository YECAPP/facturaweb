<?php 

function selectTasas($x) {
 	//Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="DESCRIP, ";
    $sql.="VALOR ";
    $sql.="FROM y_param ";
    $sql.="WHERE TP=1 ";
    
    $selectTasasData="";
    
    require 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

    foreach ($pdo->query($sql) as $row) 
    {	
        if ($row['VALOR']==$x){
            $selectTasasData.='<option selected value="'.$row['VALOR'].'">'.$row['VALOR'].'%'.'</option>';    
        }else{
            $selectTasasData.='<option value="'.$row['VALOR'].'">'.$row['VALOR'].'%'.'</option>';    
        }
        

    	
    }

    $pdo=null;
    return  $selectTasasData;
}
?>