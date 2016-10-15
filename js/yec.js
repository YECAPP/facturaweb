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
			//generando la fecha actual al dar click en nuevo 
			$("#facturaNewFecha" ).datepicker().datepicker("setDate", new Date());
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
////////////////////////////////////////
		//alert(validarFormatoFecha($("#facturaNewFecha" ).val()));
		//return false ;


		facturaButtonSave();
		$(".ydetail").fadeIn("slow",function(){});
		$("#list").fadeIn("slow",function(){

		});	
	});

function validarFormatoFecha(campo) {
      var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
      if ((campo.match(RegExPattern)) && (campo!='')) {
            return true;
      } else {
            return false;
      }
}

	//funcion que captura todos los datos de la factura y se prepara para guardarlos
	function facturaButtonSave(){
			var idfactura=$("#facturaNewHidden").val();
			var numero=$("#facturaNewNumero").val();
			var idcliente=$("#facturaNewIdcliente").val();
			if (idcliente==null || idcliente.lenght==0){
				alert("Cliente esta vacío");
				return false;
			}else{

			}
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

					$("#facturaNewHidden").val("");
					$("#facturaNewNumero").val("");
					$("#facturaNewIdcliente").val("");
					$("#facturaNewFecha").val("");		
					$("#facturaNewIdVendedor").val("");
					$("#facturaNewDescrip").val("");
					
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
	
			cantidad=$("#facturaNewLineBuscarSelectCant_"+idprod).val();
			precio=$("#facturaNewLineBuscarSelectPrec_"+idprod).val();
			tax=$("#facturaNewLineBuscarSelectTax_"+idprod).val();
			


			//alert(cantidad);
			//alert(precio);
			$.post("crud/insertYFactLine.php",{
				idprod: idprod,
				idfactura:idfact,
				cantidad: cantidad,
				precio:precio,
				tax:tax
			}, function (data,status){
				
				factline(idfact);

			});	
	}
//load factura
    function loadFactData(idfact){

        $("#facturaNewHidden").val(idfact);

        target="crud/loadYFact.php";

        $.post(target,{id:idfact},function(data,status){
            
            var fact=JSON.parse(data);

            $("#facturaNewNumero").val(fact.NUMERO);
            $("#facturaNewFecha").val(fact.FECHA);
            
            $("#facturaNewIdcliente").val(fact.IDCLIENTE);
            $("#facturaNewIdVendedor").val(fact.IDVENDEDOR);
            $("#facturaNewDescrip").val(fact.DESCRIP);
            factline(idfact);
        });

		$("#list").fadeOut("slow",function(){});
		$(".ycabecera").fadeOut("slow",function(){
		$(".ydetail").fadeIn("slow",function(){});
		});		

        //$("#prodNewForm").modal("show");
        //$("#prodNewFormButtonSubmit").attr("onclick","updateProd()");
        //$("#prodNewFormButtonSubmit").text("Cambiar");

    }


//Imprimir la facturas
	//Imprimir la factura en pdf
	function pdfFact(idfact) {			
		
		popUp('pdfFact.php?idfact='+idfact,'Factura','','1024','768','true');

	}

	function pdfSend(idfact) {			
		
		popUp('pdfFactForSend.php?idfact='+idfact,'Factura','','1024','768','true');
		

	}

function popUp(theURL,winName,features, myWidth, myHeight, isCenter) { //v3.0
  if(window.screen)if(isCenter)if(isCenter=="true"){
    var myLeft = (screen.width-myWidth)/2;
    var myTop = (screen.height-myHeight)/2;
    features+=(features!='')?',':'';
    features+=',left='+myLeft+',top='+myTop;
  }
  window.open(theURL,winName,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight);
}



//nuevo popup para buscar clientes 
function facturaClienteBuscar(str,pag){
	//capturando el id de la factura 
	var idfact=$("#facturaNewHidden").val();

	
	if (str === undefined|| str.trim()==""){
			//texbox de busqueda para nuevos clientes 
			str=$('#txtFacturaClienteBuscar').val();
		}

	//sino se ha definidio pagina poner uno 
	if (pag === undefined){
		pag=1;
	}

	var target="crud/clientLines.php";
	$.post( target, {
			idfact:idfact,
			q:str,
			pagina:pag
			}, function (data, status) {
			$("#LoadFacturaClienteBuscar").html(data);
		});		
}

$('#txtFacturaClienteBuscar').keyup(function() {
	facturaClienteBuscar($('#txtFacturaClienteBuscar').val());
});

function btnFacturaClienteBuscarSelect(idcliente,idfact){
	
	$("#facturaNewIdcliente").val(idcliente);

	 $('#formFacturaClienteBuscar').modal('toggle');
}












//funciones de clientes ***********************************************************************************************


	function deleteClient(id){
		var conf=confirm("Seguro de borrar");
		if (conf==true){
			$.post("crud/delYClient.php",{id:id},function(data,status){ client();});
		}
	}

	function loadClientData(idClie){
		$("#newHiddenId").val(idClie);

		$.post("crud/loadYClient.php",{
			id:idClie
		},function(data, status){

			var client=JSON.parse(data);

			$("#newNombre").val(client.NOMBRE);
			$("#newApellido").val(client.APELLIDO);
			$("#newEmail").val(client.EMAIL);
			
			$("#newTelefono").val(client.TELEFONO);
			$("#newCodigo").val(client.CODIGO);
			$("#newCodPost").val(client.DIRECC);
			$("#newCdad").val(client.COD_POST);
			$("#newDirecc").val(client.DIRECC);
			$("#newEstado").val(client.CDAD);
			$("#newCodtrib").val(client.ESTADO);
			$("#newEstado").val(client.CODTRIB);
		}
		);

		$("#newForm").modal("show");
		$("#clientNuevoRegistro").attr("onclick","updateClient()");
        $("#clientNuevoRegistro").text("Cambiar");
	}


	function updateClient() {
		var newNombre = $("#newNombre").val();
		var newApellido = $("#newApellido").val();
		var newEmail = $("#newEmail").val();
		var newTelefono=$("#newTelefono").val();
		var newCodigo=$("#newCodigo").val();
		var newCodPost=$("#newCodPost").val();
		var newCdad	=$("#newCdad").val();
		var newDirecc=$("#newDirecc").val();
		var newEstado=$("#newEstado").val();
		var newCodtrib=$("#newCodtrib").val();
		var newEstado=$("#newEstado").val();

		var updateIdCliente=$("#newHiddenId").val();

		$.post("crud/updateYClient.php",{
			nombre:newNombre,
			apellido:newApellido,
			email:newEmail,
			telefono:newTelefono,
			codigo:newCodigo,
			codpost:newCodPost,
			cdad:newCdad,
			direcc:newDirecc,
			estado:newEstado,
			codtrib:newCodtrib,
			estado:newEstado,
			id:updateIdCliente
			},
			function(data,status){
				
				$("#newNombre").val("");
				$("#newApellido").val("");
				$("#newEmail").val("");
				$("#newTelefono").val("");
				$("#newCodigo").val("");
				$("#newCodPost").val("");
				$("#newCdad").val("");
				$("#newDirecc").val("");
				$("#newEstado").val("");
				$("#newCodtrib").val("");
				$("#newEstado").val("");
				$("#newHiddenId").val("");

				$("#newForm").modal("hide");	
				client();	
			});
	}

	function addClient() {
		
		var newNombre = $("#newNombre").val();
		var newApellido = $("#newApellido").val();
		var newEmail = $("#newEmail").val();
		var newTelefono=$("#newTelefono").val();
		var newCodigo=$("#newCodigo").val();
		var newCodPost=$("#newCodPost").val();
		var newCdad	=$("#newCdad").val();
		var newDirecc=$("#newDirecc").val();
		var newEstado=$("#newEstado").val();
		var newCodtrib=$("#newCodtrib").val();
		var newEstado=$("#newEstado").val();
	
		$.post("crud/insertYClient.php",{
			nombre: newNombre,
			apellido: newApellido,
			email: newEmail,
			telefono:newTelefono,
			codigo:newCodigo,
			codpost:newCodPost,
			cdad:newCdad,
			direcc:newDirecc,
			estado:newEstado,
			codtrib:newCodtrib,
			estado:newEstado
		}, function (data,status){
			$("#newForm").modal("hide");
			
			alert(status);

			client();

			$("#newNombre").val("");
			$("#newApellido").val("");
			$("#newEmail").val("");
			$("#newTelefono").val("");
			$("#newCodigo").val("");
			$("#newCodPost").val("");
			$("#newCdad").val("");
			$("#newDirecc").val("");
			$("#newEstado").val("");
			$("#newCodtrib").val("");
			$("#newEstado").val("");
			$("#newHiddenId").val("");

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

