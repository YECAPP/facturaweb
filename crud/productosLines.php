<?php
if(isset($_POST['q']) && isset($_POST['idfact'])) {
    session_start();
    $q=TRIM($_POST['q']);
    $idfact=TRIM($_POST['idfact']);

    $idVendor=$_SESSION['idUser_session'];
    $idRol=$_SESSION['idRol_session'];
    
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
	
	$data='<table class="table table-condensed table-hover  table-bordered  table-responsive" >
            <thead class="thead-inverse" >
                <tr>
                    <th class="col-sm-1">Codigo Producto</th>
                    <th class="col-sm-4">Descripción</th>
                    <th class="col-sm-2">Costo</th>
                    <th class="col-sm-1">Cantidad</th>
                    <th class="col-sm-2">Precio</th>
                    <th class="col-sm-2">Tasa </th>
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

    $sqlCount="SELECT COUNT(*) FROM y_producto where descrip like '%".$q."%'";

    $total = $pdo->query($sqlCount)->fetchColumn();
    $pages = ceil($total/$TAMANO_PAGINA);

    $pageUp=ceil($pagina/$TAMANO_PAGINA)*$TAMANO_PAGINA;
    $pageDwn=$pageUp-$TAMANO_PAGINA;


//Creadno bucle de datos   

    if (empty($q)){
        $sql="SELECT * FROM y_producto limit ".$offset.",".$TAMANO_PAGINA;
    }else{
        $sql="SELECT * FROM y_producto
        where DESCRIP like '%".$q."%' limit ".$offset.",".$TAMANO_PAGINA;    
    }
    
    //$pdo = Database::connect();
    foreach ($pdo->query($sql) as $row) 
    {
        
    	$data.='<tr>';
    	$data.='<td>'.$row['CODIGO'].'</td>';
        $data.='<td>'.$row['DESCRIP'].'</td>';


        if ($idRol==1){
            $data.='<td>'.$row['COSTO'].'</td>';
        }else{
            $data.='<td>0.00</td>';
        }

        $data.='<td><input type="text" class="form-control" style="text-align:right" 
        id="facturaNewLineBuscarSelectCant_'.$row['IDPRODUCTO'].'" value="1"></td>';

        $data.='<td><input type="text" class="form-control" style="text-align:right" 
        id="facturaNewLineBuscarSelectPrec_'.$row['IDPRODUCTO'].'" value="'.$row['PRECIO'].'"></td>';

        //include_once $_SERVER['DOCUMENT_ROOT'].'/yErpsUBIR2/func.php';
        include_once 'dbfunc.php';
        $data.='<td><select class="form-control" 
        id="facturaNewLineBuscarSelectTax_'.$row['IDPRODUCTO'].'" >';
        $data.=selectTasas($row['TAX']);
        $data.='</select></td>';

        $data.='<td><button onclick="facturaNewLineBuscarSelect('.$row['IDPRODUCTO'].','.$idfact.')" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button></td>';
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
        $lcAction='onclick=" facturaNewLineBuscar('."' ',".$pagePrevious.' )"';
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
        $enlace='onclick=" facturaNewLineBuscar('."' '".','.$i.'); "';


        $data.='<li'.$classActive.'><a href="javascript:void(0)" '.$enlace.'>'.$i.'</a></li>';       
    }

    //si el pageUp es menos al numero de paginas crear el pageNext 
    if ($pageUp<$pages){
        $pageNext=$pageUp+1;
        $lcAction='onclick=" facturaNewLineBuscar('."' ',".$pageNext.' )"';
        $data.="<li><a href='#'".$lcAction." > >> </a ></li>";
    }
    $data.='</ul>';    

    $pdo=null;
    echo $data;
}
  ?>