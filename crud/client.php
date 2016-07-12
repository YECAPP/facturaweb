<?php
if(isset($_GET['q'])) {
    $q=$_GET['q'];

	//include("database.php");
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

//creando encabezado 
	$data='
            <table class="table table-condensed table-hover  table-bordered  table-responsive">
            <thead class="thead-inverse" >
                <tr>
                    <th class="col-sm-4">Nombre</th>
                    <th class="col-sm-3">Apellido</th>
                    <th class="col-sm-3">Email</th>
                </tr>
            </thead>
            <tbody>';
//terminando encabezado 

//calculando el paginado 
    $TAMANO_PAGINA = 10; 
    $pagina = 1;
    

    if(isset($_GET["pagina"])){
        $pagina = $_GET["pagina"];
    }   

    $offset=($pagina-1)*$TAMANO_PAGINA;

    $sqlCount="SELECT COUNT(*) FROM y_client where nombre like '%".$q."%'";

    $total = $pdo->query($sqlCount)->fetchColumn();
    $pages = ceil($total/$TAMANO_PAGINA);

    $pageUp=ceil($pagina/$TAMANO_PAGINA)*$TAMANO_PAGINA;
    $pageDwn=$pageUp-$TAMANO_PAGINA;

//creando bucle  tabla de datos 
    $sql="SELECT * FROM y_client where nombre like '%".$q."%' limit ".$offset.",".$TAMANO_PAGINA;
    foreach ($pdo->query($sql) as $row) 
    {
    	$data.='<tr>';
    	$data.='<td>'.$row['NOMBRE'].'</td>';
    	$data.='<td>'.$row['APELLIDO'].'</td>';
    	$data.='<td>'.$row['EMAIL'].'</td>';
        $data.='<td><button onclick="loadClientData('.$row['IDCLIENTE'].')" class="btn btn-warning">
        <span class="glyphicon glyphicon-edit"></span>
        </button></td>';
        $data.='<td><button onclick="deleteClient('.$row['IDCLIENTE'].')" class="btn btn-danger">
        <span class="glyphicon glyphicon-trash"></span>
        </button></td>';
    	$data.='</tr>';
    }
    $data.='</tbody>';
    $data.='</table>';
    $data.='<br>';


//creando bucle de paginado
    $data.='<ul class="pagination">';
    //si el pagdown es diferente de cero crear un pagePrevious
    if ($pageDwn!=0){
        $pagePrevious=$pageDwn;
        $lcAction='onclick=" client('."' ',".$pagePrevious.' )"';
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
        $enlace='onclick=" client('."' '".','.$i.'); "';


        $data.='<li'.$classActive.'><a href="javascript:void(0)" '.$enlace.'>'.$i.'</a></li>';       
    }

    
    //si el pageUp es menos al numero de paginas crear el pageNext 
    if ($pageUp<$pages){
        $pageNext=$pageUp+1;
        $lcAction='onclick=" client('."' ',".$pageNext.' )"';
        $data.="<li><a href='#'".$lcAction." > >> </a ></li>";
    }
    $data.='</ul>';    

    $pdo=null;
    echo $data;

}
?>