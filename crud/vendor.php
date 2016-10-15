<?php

if(isset($_GET['q'])) {

    $q=TRIM($_GET['q']);
    

    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
//Generando encabezado 	
	$data='<table class="table table-striped table-bordered  table-responsive">
            <thead>
                <tr>
                    <th class="col-sm-2">Nombre</th>
                    <th class="col-sm-3">Apellido</th>
                    <th class="col-sm-3">User</th>
                    <th class="col-sm-3">Pwd</th>
                    <th class="col-sm-2">Alta</th>
                    <th class="col-sm-2">Idrol</th>
                </tr>
            </thead>
            <tbody>';
//generando paginado 
    $TAMANO_PAGINA = 10; 
    $pagina = 1;
    
    if(isset($_GET["pagina"])){
        $pagina = $_GET["pagina"];
    }   

    $offset=($pagina-1)*$TAMANO_PAGINA;

    $sqlCount="SELECT COUNT(*) FROM y_user where CONCAT(nombreUsr,apellido) like '%".$q."%'";

    $total = $pdo->query($sqlCount)->fetchColumn();
    $pages = ceil($total/$TAMANO_PAGINA);

    $pageUp=ceil($pagina/$TAMANO_PAGINA)*$TAMANO_PAGINA;
    $pageDwn=$pageUp-$TAMANO_PAGINA;

//Creadno bucle de datos   
    if (empty($q)){
        $sql="SELECT * FROM y_user limit ".$offset.",".$TAMANO_PAGINA;
    }else{
        $sql="SELECT * FROM y_user 
        where UPPER(CONCAT(nombreUsr,apellido)) like '%".$q."%' limit ".$offset.",".$TAMANO_PAGINA;    
    }
    
    //$pdo = Database::connect();
    foreach ($pdo->query($sql) as $row) 
    {
        
    	$data.='<tr>';
    	$data.='<td>'.$row['nombreUsr'].'</td>';
        $data.='<td>'.$row['apellido'].'</td>';
        $data.='<td>'.$row['user'].'</td>';
        $data.='<td>'.$row['pwd'].'</td>';
        $data.='<td>'.$row['alta'].'</td>';
        $data.='<td>'.$row['idRol'].'</td>';
        $data.='<td><button onclick="loadVendorData('.$row['idUser'].')" class="btn btn-warning">
        <span class="glyphicon glyphicon-edit"></span></button></td>';
        $data.='<td><button onclick="deleteVendor('.$row['idUser'].')" class="btn btn-danger">
        <span class="glyphicon glyphicon-trash"></span></button></td>';
    	$data.='</tr>';
    }
    $data.='</tbody>';
    $data.='</table>';

//Ceeando bucle de paginado 
    $data.='<ul class="pagination">';
    //si el pagdown es diferente de cero crear un pagePrevious
    if ($pageDwn!=0){
        $pagePrevious=$pageDwn;
        $lcAction='onclick=" vendor('."' ',".$pagePrevious.' )"';
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
        $enlace='onclick=" vendor('."' '".','.$i.'); "';


        $data.='<li'.$classActive.'><a href="javascript:void(0)" '.$enlace.'>'.$i.'</a></li>';       
    }

    $pdo=null;
    echo $data;
  
}
?>