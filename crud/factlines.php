<?php
if(isset($_POST['q']) && isset($_POST['idfact'])) {
    $q=$_POST['q'];
    $idfact=$_POST['idfact'];

    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
	
	$data='<table class="table table-striped table-bordered  table-responsive">
            <thead>
                <tr>
                    <th class="col-sm-2">Codigo Producto</th>
                    <th class="col-sm-3">Descripción</th>
                    <th class="col-sm-2">Cantidad</th>
                    <th class="col-sm-2">Precio</th>
                    <th class="col-sm-2">Total</th>
                    <th class="col-sm-1">Borrar</th>
                </tr>
            </thead>
            <tbody>';
    //Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="f.LINE, ";
    $sql.="p.CODIGO, ";
    $sql.="p.DESCRIP, ";
    $sql.="p.PRECIO, ";
    $sql.="f.CANTIDAD, ";
    $sql.="p.PRECIO, ";
    $sql.="f.IDPRODUCTO, ";
    $sql.="f.IDFACTURA ";
    $sql.="FROM y_facturaline as f inner join y_producto as p on f.IDPRODUCTO=p.IDPRODUCTO ";
    $sql.="WHERE f.IDFACTURA=".$idfact;

    if (empty($q)){
        $sql.=" ";    
    }else{
        $sql.="and  DESCRIP like '%".$q."%'";
    }
    
    //$data.=$sql;
    //$pdo = Database::connect();
    foreach ($pdo->query($sql) as $row) 
    {
    	$data.='<tr>';
    	$data.='<td>'.$row['CODIGO'].'</td>';
        $data.='<td>'.$row['DESCRIP'].'</td>';
    	$data.='<td>'.$row['CANTIDAD'].'</td>';
    	$data.='<td>'.$row['PRECIO'].'</td>';
        $data.='<td>'.$row['PRECIO']*$row['CANTIDAD'].'</td>';
        $data.='<td><button onclick="deleteFactLine('.$row['IDPRODUCTO'].')" class="btn btn-danger">Borrar</button></td>';
    	$data.='</tr>';
    }

    $pdo=null;
    echo $data;
}
?>
