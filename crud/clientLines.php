<?php
//if(isset($_POST['q']) && isset($_POST['idfact'])) {
    session_start();

    $q=TRIM($_POST['q']);
    $idfact=$_POST['idfact'];


    $idVendor=$_SESSION['idUser_session'];
    $idRol=$_SESSION['idRol_session'];
    
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
	
	$data='<table class="table table-condensed table-hover  table-bordered  table-responsive" >
            <thead class="thead-inverse" >
                <tr>
                    <th class="col-sm-1">Codigo Cliente</th>
                    <th class="col-sm-4">Nombre</th>
                    <th class="col-sm-1">Codigo Tributario</th>
                    <th class="col-sm-2">Estado</th>
                    <th class="col-sm-2">Ciudad</th>
                    <th class="col-sm-2">Codigo Postal</th>
                </tr>
            </thead>
            <tbody>';

//generando paginado 
    $TAMANO_PAGINA = 5; 
    $pagina = 1;
    
    if(isset($_POST["pagina"])){
        $pagina = $_POST["pagina"];
    }   

    $offset=($pagina-1)*$TAMANO_PAGINA;

    $sqlCount="SELECT COUNT(*) FROM y_client where NOMBRE like '%".$q."%'";

    $total = $pdo->query($sqlCount)->fetchColumn();
    $pages = ceil($total/$TAMANO_PAGINA);

    $pageUp=ceil($pagina/$TAMANO_PAGINA)*$TAMANO_PAGINA;
    $pageDwn=$pageUp-$TAMANO_PAGINA;


//Creadno bucle de datos   

    if (empty($q)){
        $sql="SELECT * FROM y_client limit ".$offset.",".$TAMANO_PAGINA;
    }else{
        $sql="SELECT * FROM y_client
        where NOMBRE like '%".$q."%' limit ".$offset.",".$TAMANO_PAGINA;    
    }
    
    //$pdo = Database::connect();
    foreach ($pdo->query($sql) as $row) 
    {
        
    	$data.='<tr>';
    	$data.='<td>'.$row['CODIGO'].'</td>';
        $data.='<td>'.$row['NOMBRE'].'</td>';
        $data.='<td>'.$row['CODTRIB'].'</td>';
        $data.='<td>'.$row['ESTADO'].'</td>';
        $data.='<td>'.$row['CDAD'].'</td>';
        $data.='<td>'.$row['COD_POST'].'</td>';
        $data.='<td><button onclick="btnFacturaClienteBuscarSelect('.$row['IDCLIENTE'].','.$idfact.')" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button></td>';
    	$data.='</tr>';
    }
    $data.='</tbody>';
    $data.='</table>';
    


//Ceeando bucle de paginado 
    $data.='<ul class="pagination">';
    //si el pagdown es diferente de cero crear un pagePrevious
    if ($pageDwn!=0){
        $pagePrevious=$pageDwn;
        //$lcAction='onclick=" prod('."' ',".$pagePrevious.' )"';
        $lcAction='onclick=" facturaClienteBuscar('."' ',".$pagePrevious.' )"';
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
        $enlace='onclick=" facturaClienteBuscar('."' '".','.$i.'); "';


        $data.='<li'.$classActive.'><a href="javascript:void(0)" '.$enlace.'>'.$i.'</a></li>';       
    }

    //si el pageUp es menos al numero de paginas crear el pageNext 
    if ($pageUp<$pages){
        $pageNext=$pageUp+1;
        $lcAction='onclick=" facturaClienteBuscar('."' ',".$pageNext.' )"';
        $data.="<li><a href='#'".$lcAction." > >> </a ></li>";
    }
    $data.='</ul>';    



    $pdo=null;
    echo $data;
//}
  ?>