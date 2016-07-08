<?php
if(isset($_GET['q'])) {
    $q=$_GET['q'];

	//include("database.php");
    require_once 'dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
	
	$data='<table class="table table-striped table-bordered  table-responsive">
            <thead>
                <tr>
                    <th class="col-sm-4" >NOMBRE</th>
                    <th class="col-sm-3">APELLIDO</th>
                    <th class="col-sm-3">EMAIL</th>
                    <th class="col-sm-1">MODIFICAR</th>
                    <th class="col-sm-1">ACTUALIZAR</th>
                </tr>
            </thead>
            <tbody>';
    
    $TAMANO_PAGINA = 10; 
    $pagina = 1;
    $inicio = 0;
    
    if(isset($_GET["pagina"])){
        $pagina = $_GET["pagina"];
        $inicio = ($pagina - 1) * $TAMANO_PAGINA;
    }   




    $sql="SELECT * FROM y_client where nombre like '%".$q."%'";
    
    //$pdo = Database::connect();
    foreach ($pdo->query($sql) as $row) 
    {
    	$data.='<tr>';
    	$data.='<td>'.$row['NOMBRE'].'</td>';
    	$data.='<td>'.$row['APELLIDO'].'</td>';
    	$data.='<td>'.$row['EMAIL'].'</td>';
        $data.='<td><button onclick="loadClientData('.$row['IDCLIENTE'].')" class="btn btn-warning">Mod</button></td>';
        $data.='<td><button onclick="deleteClient('.$row['IDCLIENTE'].')" class="btn btn-danger">Borrar</button></td>';
    	$data.='</tr>';
    }
    $pdo=null;
    echo $data;
}
  ?>