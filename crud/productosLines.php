<?php
if(isset($_POST['q']) && isset($_POST['idfact'])) {
    
    $q=TRIM($_POST['q']);
    $idfact=TRIM($_POST['idfact']);

    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
	
	$data='<table class="table table-striped table-bordered  table-responsive">
            <thead>
                <tr>
                    <th class="col-sm-2">Codigo Producto</th>
                    <th class="col-sm-3">Descripción</th>
                    <th class="col-sm-2">Precio</th>
                    <th class="col-sm-2">COSTO</th>
                    <th class="col-sm-1">Sel</th>
                </tr>
            </thead>
            <tbody>';
    
    if (empty($q)){
        $sql="SELECT * FROM y_producto";
    }else{
        $sql="SELECT * FROM y_producto where DESCRIP like '%".$q."%'";    
    }
    
    //$pdo = Database::connect();
    foreach ($pdo->query($sql) as $row) 
    {
        
    	$data.='<tr>';
    	$data.='<td>'.$row['CODIGO'].'</td>';
        $data.='<td>'.$row['DESCRIP'].'</td>';
        $data.='<td>'.$row['PRECIO'].'</td>';
        $data.='<td>'.$row['COSTO'].'</td>';
        $data.='<td><button onclick="facturaNewLineBuscarSelect('.$row['IDPRODUCTO'].','.$idfact.',1)" class="btn btn-danger">Sel</button></td>';
    	$data.='</tr>';
    }
    $data.='</tbody>';
    $data.='</table>';
    
    $pdo=null;
    echo $data;
}
  ?>