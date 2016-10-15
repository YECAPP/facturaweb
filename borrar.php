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
	<a href="pdfFactura.php" clas="btn btn-default">
		Generar pdf
	</a>
	<?php echo dirname(__FILE__);?>
</div>
	<div class="panel-footer">
		PDF	
	</div>
</div>


</div>


<div class="panel panel-primary">

<div class=panel-header>
	<h3>Celdas Ceil()</h3>
	<h5>valores ceil </h5>
</div>
<div class="panel-body">
<?php echo 150%50;?>

</div>
	<div class="panel-footer">
		ceil
	</div>
</div>


</div>

<div class="panel panel-primary" >
	<div class="panel-header">
		<select class="form-control" id="newTax">
	         <option value=21>Tasa General(21)</option>
	         <option value=10>Tasa Reducida(10)</option>
	         <option value=4>Tasa Super Reducida(4)</option>
         </select>
	</div>
	<div class="panel-footer">
	<button id="Value" class="btn btn-danger">
		Cambiar Valor 
	</button>
	<hr>
	
	<?php
		$lcSelect='<select class="form-control" id="newTax">';
		$lcSelect.= selectTasas(21);
		$lcSelect.='</select>';
		echo $lcSelect;

	?>
	
	</hr>
	<?php 	
		$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
		echo $root;
		echo $_SERVER['HTTP_HOST'];
		$parsedUrl = parse_url('http://localhost/some/folder/containing/something/here/or/there');
		echo "<br>";
		echo $parsedUrl;
		echo "<br>";
		echo $parsedUrl['scheme'];
		echo "<br>";
 		echo $parsedUrl['host'];
	?>

  </div>
</div>

</div>
<hr>
<hr>

<script>
$("#Value").click(function(){
	var valor = document.getElementById("newTax");
	alert(valor);

	$("#newTax").val(4);



})
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

<?php include_once 'crud/productosLines.php';?>	
</script>
<?php
setlocale(LC_MONETARY, 'es_ES.UTF-8');

echo money_format('%i', 100.12) . "\n";

?>
<?php include_once 'template/foot.php';?>


