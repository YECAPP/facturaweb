<?php
if(isset($_POST['q'])) {
    $q=$_POST['q'];

	//include("database.php");
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

	
	$data='<table class="table table-striped table-bordered  table-responsive">
            <thead>
                <tr>
                    <th class="col-sm-2">Numero</th>
                    <th class="col-sm-3">Descripción</th>
                    <th class="col-sm-2">Cliente</th>
                    <th class="col-sm-2">Fecha</th>
                    <th class="col-sm-1">Borrar</th>
                </tr>
            </thead>
            <tbody>';
    //Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="f.IDFACTURA, ";
    $sql.="f.NUMERO, ";
    $sql.="f.DESCRIP, ";
    $sql.="c.NOMBRE, ";
    $sql.="f.FECHA ";
    $sql.="FROM y_factura as f inner join y_client as c on f.IDCLIENTE=c.IDCLIENTE ";
    if (empty($q)){
        $sql.=" ";    
    }else{
        $sql.="and  c.NOMBRE+f.DESCRIP like '%".$q."%'";
    }
    
    //$data.=$sql;
    //$pdo = Database::connect();
    foreach ($pdo->query($sql) as $row) 
    {
    	$data.='<tr>';
    	$data.='<td>'.$row['NUMERO'].'</td>';
        $data.='<td>'.$row['DESCRIP'].'</td>';
    	$data.='<td>'.$row['NOMBRE'].'</td>';
    	$data.='<td>'.$row['FECHA'].'</td>';
        $data.='<td><button onclick="deleteFact('.$row['IDFACTURA'].')" class="btn btn-danger">Borrar</button></td>';
    	$data.='</tr>';
    }

    $pdo=null;
    echo $data;
}
?>
