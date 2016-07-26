/*
Author: Yuri Ernesto Calderón 
Alias: YEC
URL: http://www.tiservicios.net/
email:ventas@tiservicios.net
*/
//Asignacion de eventos

//codigo para el incio
$( 'a#logOut' ).attr("href", "logout.php");
$( 'a#perfil' ).attr("href", "perfil.php");


$('document').ready(function(){ 
     /* validation */
	   /* login submit */
	$(".ydetail").hide(); 
 
/*	$.get("crud/borrar.php", {}, function (data, status) {
		alert("ya estuvo");
	});	
*/

//guardando los datpiccker 
	

});






















//funciones facturas****************************************************************************************
	
	//controles de facturas 
	//textbox para buscar facturas 
	$('#textFacturaBoxSearch').keyup(function() {
		fact($('#textFacturaBoxSearch').val());
	});
	//fecha datepicker para generar calendario en la factura
	$("#facturaNewFecha" ).datepicker({ dateFormat: 'yy-mm-dd' });


	//cerrar factura; oculta el ydetail, muestra la cabcera y luego la lista de facturas
	$('#facturaButtonNewClose').click(function() {
		$(".ydetail").fadeOut("slow",function(){
			$(".ycabecera").fadeIn("slow",function(){
				$("#list").fadeIn("slow",function(){});		
			});
		});
	});

	function deleteFact(idfactura){
		var conf=confirm("Seguro de borrar");
		if (conf==true){
			$.post("crud/delYFact.php",{idfactura:idfactura},function(data,status){ 
				fact($('#textFacturaBoxSearch').val());
			});
		}}		

//crear nueva factura, reserva y guarda el id de la nueva factura generada en un hidden
	$('#facturaButtonNew').click(function() {
		
		$.get( "crud/facturaReserve.php", {}, function (data, status) {
			
			var arr=eval(data);

			//el php devuelve un array con todos los datos de reserva, luego hay que ponerlos en cada control 
			$('#facturaNewHidden').val(arr[0]);
			$('#facturaNewNumero').val(arr[1]);
			$('#facturaNewIdVendedor').val(arr[2]);
			$("#facturaNewIdVendedor").attr("disabled", true);
			$("#facturaNewNumero").prop("readonly", true);
		});
		//ocultar el listado de facturas 
		$("#list").fadeOut("slow",function(){});
		$(".ycabecera").fadeOut("slow",function(){
		$(".ydetail").fadeIn("slow",function(){});
		});		
	});

//guardar la factura completa, llama a facturaButtonSave() y luego oculta los paneles
	$('#facturaButtonSave').click(function() {
		facturaButtonSave();
		$(".ydetail").fadeIn("slow",function(){});
		$("#list").fadeIn("slow",function(){
			
		});	
	});

	//funcion que captura todos los datos de la factura y se prepara para guardarlos
	function facturaButtonSave(){
			var idfactura=$("#facturaNewHidden").val();
			var numero=$("#facturaNewNumero").val();
			var idcliente=$("#facturaNewIdcliente").val();

			var fecha=$("#facturaNewFecha").val();
			
			var idvendedor=$("#facturaNewIdVendedor").val();

			var descrip=$("#facturaNewDescrip").val();
			
			
			var target="crud/insertYFact.php";

			$.post( target, {
				idfactura:idfactura,
				numero:numero,
				idcliente:idcliente,
				fecha:fecha,
				idvendedor:idvendedor,
				descrip:descrip
				}, function (data, status) {

					var idfactura=$("#facturaNewHidden").val("");
					var numero=$("#facturaNewNumero").val("");
					var idcliente=$("#facturaNewIdcliente").val("");
					var fecha=$("#facturaNewFecha").val("");		
					var idvendedor=$("#facturaNewIdVendedor").val("");
					var descrip=$("#facturaNewDescrip").val("");
					$(".ycabecera").fadeIn("slow",function(){
					$(".ydetail").fadeOut();	});
					$("#facturaLine").html("<p class='text-center bg-info><br><br><br>Sin productos<br><br><br></p>");
					fact($('#textFacturaBoxSearch').val());
			});			
		}

	//Generar el listado de facturas el el div loaded, este procedimiento recibe dos parametros el str de busqueda y la pagina
	function fact(str,pag) {			
		
        if (str === undefined || str.trim()==""){
            str=$('#textFacturaBoxSearch').val();
        }
        
        if (pag === undefined){
            pag=1;
        }

			var target="crud/fact.php";
		    $.post( target, {
		    	q:str,
		    	pagina:pag
		    	}, function (data, status) {
		        	$("#loaded").html(data);
		    });
		}

//genera el detalle de la factura  cuando se abre una faactura 
	function factline(idfact,str) {
			
			if (str === undefined){
				//str=$('#textBoxSearch').val();
				str="";
			}

			var target="crud/factlines.php";
		    $.post( target, {
		    	idfact:idfact,
		    	q:str
		    	}, function (data, status) {
		    		
		        	$("#facturaLine").html(data);
		    });
		}	

	function deleteFactLine(line,idfactura){
		var conf=confirm("Seguro de borrar");
		if (conf==true){
			$.post("crud/delYFactLine.php",{line:line},function(data,status){ 
				factline(idfactura);
			});
		}		
	}



//form modal para busqueda de productos, llamada por busqueda de productos,recibe  un str de busqueda de produtos y un numero de pagina ya que el formulario modal debe paginar los resultados
	//TextBox para buscar productos en el formulario modal 
	$('#facturaNewLineBuscar').keyup(function() {
		facturaNewLineBuscar(
			$('#facturaNewLineBuscar').val()
		);
	});
	
	//Boton Nuevo Producto, manda a llamar el listado de producto en el modal
	$('#facturaNewLineBuscarProdButton').click(function(){
		facturaNewLineBuscar();
	});

	function facturaNewLineBuscar(str,pag) {

		
		var idfact=$("#facturaNewHidden").val();

		if (str === undefined|| str.trim()==""){
			//texbox de busqueda para nuevos productos
			str=$('#facturaNewLineBuscar').val();
		}

		if (pag === undefined){
			pag=1;
		}


		var target="crud/productosLines.php";

		$.post( target, {
			idfact:idfact,
			q:str,
			pagina:pag
			}, function (data, status) {
			$("#facturaNewLineBuscarProd").html(data);
		});		
	}

	//Boton seleccionar productos desde el cuadro modal 
	function facturaNewLineBuscarSelect(idprod,idfact) {
			/*alert(idprod);file
			alert(idfact);*/
			

			cantidad=$("#facturaNewLineBuscarSelectCant_"+idprod).val();
			precio=$("#facturaNewLineBuscarSelectPrec_"+idprod).val();

			//alert(cantidad);
			//alert(precio);
			$.post("crud/insertYFactLine.php",{
				idprod: idprod,
				idfactura:idfact,
				cantidad: cantidad,
				precio:precio
			}, function (data,status){
				
				factline(idfact);

			});	
	}


























//funciones de clientes ***********************************************************************************************
	function deleteClient(id){
		var conf=confirm("Seguro de borrar");
		if (conf==true){
			$.post("crud/delYClient.php",{id:id},function(data,status){ client();});
		}
	}

	function loadClientData(idClie){
		$("#updateHiddenId").val(idClie);

		$.post("crud/loadYClient.php",{
			id:idClie
		},function(data, status){

			var client=JSON.parse(data);


			$("#updateNombre").val(client.NOMBRE);
			$("#updateApellido").val(client.APELLIDO);
			$("#updateEmail").val(client.EMAIL);

		}
		);

		$("#updateForm").modal("show");
	}


	function updateClient() {
		var updateNombre = $("#updateNombre").val();
		var updateApellido = $("#updateApellido").val();
		var updateEmail = $("#updateEmail").val();

		var updateIdCliente=$("#updateHiddenId").val();

		$.post("crud/updateYClient.php",{
			nombre:updateNombre,
			apellido:updateApellido,
			email:updateEmail,
			id:updateIdCliente
			},
			function(data,status){
				$("#updateForm").modal("hide");	
				client();	
			});
	}

	function addClient() {

		var newNombre=$("#newNombre").val();
		var newApellido=$("#newApellido").val();
		var newEmail=$("#newEmail").val();
		

		
		$.post("crud/insertYClient.php",{
			nombre: newNombre,
			apellido: newApellido,
			email: newEmail
		}, function (data,status){
			$("#newForm").modal("hide");
			
			client();

			$("#newNombre").val("");
			$("#newApellido").val("");
			$("#newEmail").val("");
		});
	}


	function addRecord() {

		var newNombre=$("#newNombre").val();
		var newApellido=$("#newApellido").val();
		var newEmail=$("#newEmail").val();
		
		
		$.post("crud/insertYClient.php",{
			nombre: newNombre,
			apellido: newApellido,
			email: newEmail
		}, function (data,status){
			$("#newForm").modal("hide");
			
			client();

			$("#newNombre").val("");
			$("#newApellido").val("");
			$("#newEmail").val("");
		});
	}

	function client(str,pag) {
		
		if (str === undefined || str.trim()==""){
			str=$('#textBoxSearch').val();
		}
		
		if (pag === undefined){
			pag=1;
		}

		var target="crud/client.php?q="+str+"&pagina="+pag;
	    $.get( target, {}, function (data, status) {
	        $("#loaded").html(data);
	    });
	}


//funciones de clientes 

