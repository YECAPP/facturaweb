<?php  session_start();
  if(!isset($_SESSION['user_session']))
  {
    header("Location: index.php");
  }
?>
<?php include_once 'func.php';?>
<!--Incluir funciones-->
<?php include_once 'template/head.php';?>

 <?php include_once 'template/navbar.php';?>
<!--Contenedor -->
<div class="container ">

<div class="panel panel-primary">
  <div class="panel-body">Tabla ejemplo
		<table id="myTable" class="table table-condensed table-hover  table-bordered  table-responsive">
		<tr>
			<td>celda uno </td>
			<td>celda dos </td>
		</tr>
		</table>
  </div>

  <div class="panel-footer">Tabla 
	<button id="Add" class="btn btn-danger">
		Agregar
	</button>
  </div>

<!--Panel de pruebas para pdf -->

<div class="panel panel-primary">

<div class=panel-header>
	<h3>Impresion en pdf </h3>
	<h5>Prueba</h5>
</div>
<div class="panel-body">
	<a href="pdfExample.php" clas="btn btn-default">
		Generar pdf
	</a>
	<?php echo dirname(__FILE__);?>
</div>
	<div class="panel-footer">
		PDF	
	</div>
</div>


</div>


</div>
<script>
$("#Add").click(function(){
	var x = document.getElementById("myTable").rows.length;
	
	var table = document.getElementById("myTable");

	// Create an empty <tr> element and add it to the 1st position of the table:
	var row = table.insertRow(x);

	// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);

	// Add some text to the new cells:
	cell1.innerHTML = "NEW CELL"+x;
	cell2.innerHTML = "NEW CELL"+x;
});
	
</script>
<?php
setlocale(LC_MONETARY, 'es_ES.UTF-8');

echo money_format('%i', 100.12) . "\n";
phpinfo();
?>
<?php include_once 'template/foot.php';?>


