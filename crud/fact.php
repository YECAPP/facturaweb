<?php
if(isset($_POST['q'])) {
    $q=$_POST['q'];
    session_start();
    $idVendor=$_SESSION['idUser_session'];
    $idRol=$_SESSION['idRol_session'];

//buce de datos 
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

	$data='<table class="table table-condensed table-hover  table-bordered  table-responsive" >
            <thead class="thead-inverse" >
                <tr>
                    <th class="col-sm-2">Numero</th>
                    <th class="col-sm-3">Descripción</th>
                    <th class="col-sm-3">Cliente</th>
                    <th class="col-sm-2">Fecha</th>
                </tr>
            </thead>
            <tbody>';


//generando paginado 
    $TAMANO_PAGINA = 10; 
    $pagina = 1;
    
    if(isset($_POST["pagina"])){
        $pagina = $_POST["pagina"];
    }   

    $offset=($pagina-1)*$TAMANO_PAGINA;

    if ($idRol==1){
        $sqlCount="SELECT COUNT(*) FROM  y_factura as f inner join y_client as c on f.IDCLIENTE=c.IDCLIENTE
        where  CONCAT(c.NOMBRE,f.DESCRIP) like '%".$q."%'";
    }else{
        $sqlCount="SELECT COUNT(*) FROM  y_factura as f inner join y_client as c on f.IDCLIENTE=c.IDCLIENTE
        where IDVENDEDOR=".$idVendor." and CONCAT(c.NOMBRE,f.DESCRIP) like '%".$q."%'";
    }

    $total = $pdo->query($sqlCount)->fetchColumn();
    $pages = ceil($total/$TAMANO_PAGINA);

    $pageUp=ceil($pagina/$TAMANO_PAGINA)*$TAMANO_PAGINA;
    $pageDwn=$pageUp-$TAMANO_PAGINA;


    //Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="f.IDFACTURA, ";
    $sql.="f.NUMERO, ";
    $sql.="f.DESCRIP, ";
    $sql.="c.NOMBRE, ";
    $sql.="f.FECHA ";
    $sql.="FROM y_factura as f inner join y_client as c on f.IDCLIENTE=c.IDCLIENTE ";
    

    

    if (empty($q)){
        if ($idRol==1){
            $sql.=" limit ".$offset.",".$TAMANO_PAGINA;    
        }else{
            $sql.="WHERE IDVENDEDOR=".$idVendor." ";
            $sql.=" limit ".$offset.",".$TAMANO_PAGINA;    
        }
            
        
    }else{
        if ($idRol==1){
            $sql.="where  CONCAT(c.NOMBRE,f.DESCRIP) like '%".$q."%' limit ".$offset.",".$TAMANO_PAGINA;
        }else{
            $sql.="where and  IDVENDEDOR=".$idVendor." CONCAT(c.NOMBRE,f.DESCRIP) like '%".$q."%' limit ".$offset.",".$TAMANO_PAGINA;
        }
    }


//bucle de datos 
    foreach ($pdo->query($sql) as $row) 
    {
    	$data.='<tr>';
    	$data.='<td>'.$row['NUMERO'].'</td>';
        $data.='<td>'.$row['DESCRIP'].'</td>';
    	$data.='<td>'.$row['NOMBRE'].'</td>';
    	$data.='<td>'.$row['FECHA'].'</td>';
        $data.='<td><button onclick="loadFactData('.$row['IDFACTURA'].')" class="btn btn-warning">
        <span class="glyphicon glyphicon-edit"></span></button></td>';
        $data.='<td><button onclick="deleteFact('.$row['IDFACTURA'].')" class="btn btn-danger">
        <span class="glyphicon glyphicon-trash"></span></button></td>';
        $data.='<td><button onclick="pdfFact('.$row['IDFACTURA'].')" class="btn btn-info">
        <span class="glyphicon glyphicon-print"></span></button></td>';
        $data.='<td><button onclick="pdfSend('.$row['IDFACTURA'].')" class="btn btn-info">
        <span class="glyphicon glyphicon-envelope"></span></button></td>';

        $data.='</tr>';
    }
    $data.='</tbody>';
    $data.='</table>';


//Creando bucle de paginado 
    $data.='<ul class="pagination">';
    //si el pagdown es diferente de cero crear un pagePrevious
    if ($pageDwn!=0){
        $pagePrevious=$pageDwn;
        $lcAction='onclick=" fact('."' ',".$pagePrevious.' )"';
        $data.="<li><a href='#'".$lcAction." > << </a ></li>";
    }
    
    //si el pagUp es mayor que el numero de paginas, dejar como pageTop el numero de paginas 
    if ($pageUp>=$pages){
        $pageTop=$pages;
    }else{
        $pageTop=$pageUp;
    }

    //bucle de paginacion 
    for ($i=1+$pageDwn;$i<=$pageTop;$i++){
        //Determinate Active Class
        if ($pagina==$i){  
            $classActive=' class="active" ';
        }else {
            $classActive='';
        }
        //Create Link 
        $enlace='onclick=" fact('."' '".','.$i.'); "';


        $data.='<li'.$classActive.'><a href="javascript:void(0)" '.$enlace.'>'.$i.'</a></li>';       
    }




    $pdo=null;
    echo $data;
}
?>
