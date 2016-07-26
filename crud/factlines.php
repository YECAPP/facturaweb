<?php
if(isset($_POST['q']) && isset($_POST['idfact'])) {
    $q=$_POST['q'];
    $idfact=$_POST['idfact'];

    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
	
	$data='<table class="table table-bordered table-hover  ">
            <thead >
                <tr>
                    <th class="col-sm-2">Codigo Producto</th>
                    <th class="col-sm-3">Descripción</th>
                    <th class="col-sm-2">Cantidad</th>
                    <th class="col-sm-2">Precio</th>
                    <th class="col-sm-2">Total</th>
                </tr>
            </thead>
            <tbody>';
    //Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="f.LINE, ";
    $sql.="p.CODIGO, ";
    $sql.="p.DESCRIP, ";
    $sql.="f.CANTIDAD, ";
    $sql.="f.PRECIO, ";
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
    $subTotal=0.00;
    foreach ($pdo->query($sql) as $row) 
    {
    	$data.='<tr>';
    	$data.='<td>'.$row['CODIGO'].'</td>';
        $data.='<td>'.$row['DESCRIP'].'</td>';
    	$data.='<td>'.$row['CANTIDAD'].'</td>';
    	$data.='<td>'.$row['PRECIO'].'</td>';
        $data.='<td>'.$row['PRECIO']*$row['CANTIDAD'].'</td>';
        $data.='<td><button onclick="deleteFactLine('.$row['LINE'].','.$row['IDFACTURA'].')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>';
    	$data.='</tr>';
        $subTotal+=$row['PRECIO']*$row['CANTIDAD'];
    }
        
        setlocale(LC_MONETARY, 'es_ES.UTF-8');

        $data.='<tfoot  class="table">';
        $data.='<tr >';
        $data.='<th class="text-right  "  colspan="4">subTotal:</th>';
        $data.='<th class="text-right info">'.money_format("%.2n",$subTotal).'</th>';
        $data.='</tr>';

        $data.='<tr class="text-right">';
        $data.='<th class="text-right " colspan="4">Iva:</th>';
        $data.='<th class="text-right info">'.money_format("%.2n",round($subTotal*0.21,2)).'</th>';
        $data.='</tr>';
        

        $data.='<tr class="text-right">';
        $data.='<th class="text-right " colspan="4">Total:</th>';
        $data.='<th class="text-right info">'.money_format("%.2n",round($subTotal*1.21,2)).'</th>';
        $data.='</tr>';


        $data.='</tfoot></table>';
    $pdo=null;
    echo $data;
}
?>
