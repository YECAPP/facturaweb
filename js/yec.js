/*
Author: Pradeep Khodke
URL: http://www.codingcage.com/
*/
//Asignacion de eventos


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

$( 'a#logOut' ).attr("href", "logout.php");
$( 'a#perfil' ).attr("href", "perfil.php");

$('#buttonLoad').click(function() {
	client(" ");  		
});


$('#textBoxSearch').keyup(function() {
	client($('#textBoxSearch').val());
});


//funciones facturas 
	//control fecha en factura 
	
	$('#facturaButtonLoad').click(function() {
		fact($('#facturaButtonLoad').val());
	});

	$('#textFacturaBoxSearch').keyup(function() {
		fact($('#textFacturaBoxSearch').val());
	});


	$("#facturaNewFecha" ).datepicker({ dateFormat: 'yy-mm-dd' });

	//boton nueva factura para cambiar a vista de nueva factura 
	$('#facturaButtonNew').click(function() {
		$(".ycabecera").fadeOut("slow",function(){
			$(".ydetail").fadeIn("slow",function(){});
		});		
	});
	//cerrar factura 
	$('#facturaButtonNewClose').click(function() {
		$(".ycabecera").fadeIn("slow",function(){
			$(".ydetail").fadeOut();	});	
	});

	//factura nueva linea para buscar un producto seleccionar y poner la linea en la factura 
	$('#facturaNewLineBuscar').keyup(function() {
		facturaNewLineBuscar(
			$('#facturaNewLineBuscar').val()
		);
	});



	//crear nueva factura, reserva y guarda el id de la nueva factura generada en un hidden
	$('#facturaButtonNew').click(function() {
		$(".ydetail").hide();
		$.get( "crud/facturaReserve.php", {}, function (data, status) {
			$('#facturaNewHidden').val(data);
		});	

	});

	//guardar la factura completa
	$('#facturaButtonSave').click(function() {
		facturaButtonSave();
		$(".ydetail").fadeIn();		
	});

	//inserta factura cabecera
	function fact(str) {
			
			if (str === undefined){
				//str=$('#textBoxSearch').val();
				str="";
			}

			var target="crud/fact.php";
		    $.post( target, {
		    	q:str
		    	}, function (data, status) {
		    		
		        	$("#loaded").html(data);
		    });
		}

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

		});			
	}

	//llamada por busqueda de productos 
	function facturaNewLineBuscar(str) {

		//var idfact= newNombre=$("#facturaNewHidden").val();
		var idfact=$("#facturaNewHidden").val();

		if (str === undefined){
			//str=$('#textBoxSearch').val();
			str="";
		}

		var target="crud/productosLines.php";

		$.post( target, {
			idfact:idfact,
			q:str
			}, function (data, status) {
			$("#facturaNewLineBuscarProd").html(data);
		});		
	}

	function facturaNewLineBuscarSelect(idprod,idfact,cantidad) {
			/*alert(idprod);file
			alert(idfact);
			alert(cantidad);*/
			$.post("crud/insertYFactLine.php",{
				idprod: idprod,
				idfactura:idfact,
				cantidad: cantidad
			}, function (data,status){
				
				factline(idfact);

			});
		
	}

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
//funciones facturas 


//funciones de clientes 
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

	// function client(str) {
		
	// 	if (str === undefined){
	// 		str=$('#textBoxSearch').val();
	// 	}

	// 	var target="crud/client.php?q="+str;
	//     $.get( target, {}, function (data, status) {
	//         $("#loaded").html(data);
	//     });
	// }
//funciones de clientes 


//funciones de productos 
	
//funciones de productos 


//funciones login form 

// $("#login-form").validate({
//       rules:
// 	  {
// 			password: {
// 			required: true,
// 			},
// 			user_email: {
//             required: true,
//             email: true
//             },
// 	   },
//        messages:
// 	   {
//             password:{
//                       required: "Introduzca su Password"
//                      },
//             user_email: "Ingrese su email",
//        },
// 	   submitHandler: submitForm	
//        });  

// function submitForm()
// 	   {		
// 			var data = $("#login-form").serialize();
			
// 			$.ajax({
				
// 			type : 'POST',
// 			url  : 'Login_process.php',
// 			data : data,
// 			beforeSend: function()
// 			{	
// 				$("#error").fadeOut();
// 				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
// 			},
// 			success :  function(response)
// 			   {		
// 			   		if(response.trim()=="ok"){
// 			   			alert("entro");
// 			   			window.location.href="home.php";
// 			   		}

// 					// if(response.trim()=="ok"){
						
// 					// 	$("#btn-login").html("entro");
// 					// 	$("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
// 					// 	setTimeout('window.location.href="home.php"; ',4000);
						
// 					// }
// 					// else{
						
// 					// 	$("#error").fadeIn(1000, function(){						
// 					// 	$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
// 					// 	$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
// 					// 	});
// 					// }
// 			  }
// 			});
// 				return false;
// 		}
// //funciones login form 

//papelero
	// $('#prueba').click(function() {


		// 	var idfact=82 ; 
		// 	var idprod=3 ; 
		// 	var cantidad=3 ; 

		// 	$.post("crud/insertYFactLine.php",{
		// 			idprod: idprod,
		// 			idfactura: idfact,
		// 			cantidad: cantidad
		// 		}, function (data,status){
					
		// 			alert(data);
		// 			//factline(idfact);
		// 		});
	// });


	// $('#facturaNewIdcliente').load(function() {
	// 	var target="crud/facturaNewIdclienteSelect"
	// 	$.post( target, {
	// 			idfact:idfact,
	// 			q:str
	// 			}, function (data, status) {
	// 			$("#facturaNewLineBuscarProd").html(data);
	// 		});			
	// });
//papelero