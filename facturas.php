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
    <div class="container">
    <!--ycabecera-->
        <!--<div class="ycabecera bg-primary">-->
        <div class="panel panel-primary ycabecera">
            <div class="panel-heading" >
                <div class="row " >
                    <div class="col-md-12">
                        <h3>Facturas</h3>
                        <hr>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-10 ">
                        <input type="text" class=" form-control"  placeholder="Introduzca su busqueda" id="textFacturaBoxSearch">
                    </div>
                   
                    <div class="col-md-2">
                        <button id="facturaButtonNew" class="btn btn-default pull-right"   >
                        Nuevo
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row " id="list" >
                    <div class="col-md-12" id="loaded"></div>
                </div>    
            </div>
            <div class="panel-footer">
                <div class="row ">
                    <div class="col-md-12 text-right">
                        Facturas        
                    </div>
                </div>
            </div>
        </div>
        

        
    <!--ycabecera-->
    <!--ylist-->
    <div class="panel panel-primary ydetail">
        <div class="panel-heading" >
            <div class="modal-header">
                <button id="facturaButtonNewClose" type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                    Cerrar
                </button>
                <h4 class="modal-title" id="myModalLabel">Nueva Factura</h4>
            </div> 
        </div>
        <div class="panel-body">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="facturaNewNumero">Numero</label>
                        <input type="text" id="facturaNewNumero" placeholder="Número Factura" class="form-control"/>
                    </div>
                    <div class="form-group col-md-10">
                        
                            <label for="facturaNewIdcliente">Cliente</label>
                            <select class="form-control" id="facturaNewIdcliente">
                                <?php include_once 'crud/clientSelectTag.php'; ?>
                            </select>
                    </div> 
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="facturaNewFecha">Fecha</label>
                        <input type="text" id="facturaNewFecha" placeholder="Fecha" class="form-control"/>
                        
                    </div>
                    <div class="form-group col-md-2">
                        <label for="facturaNewIdVendedor">Vendedor</label>
                           <select class="form-control" id="facturaNewIdVendedor">
                                <option value="1">Vendedor 1 </option>
                                <option value="2">Vendedor 2 </option>
                           </select>
                        <!--<input type="text" id="facturaNewIdVendedor" placeholder="Last Name" class="form-control"/>-->
                    </div>
                    <div class="form-group col-md-8">
                        <label for="facturaNewDescrip">Descripción</label>
                        <input type="text" id="facturaNewDescrip" placeholder="Descripción" class="form-control"/>
                    </div>
                    <div class="form-group col-md-8">
                    <button class="btn btn-default" id="facturaNewLineBuscarProdButton" data-toggle="modal"data-target="#facturaNewForm" >
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        Nuevo Producto
                    </button>
                    <input type="hidden" id="facturaNewHidden">
                    </div>
                </div>
                <!--<div class="row">
                    
                </div>-->
                <!--Div para cargar las lineas de los productos que se agregan a la factura -->
                <div class="row " id="facturaLine" style="padding-top: 10px;padding-bottom: 10px">
                <div class="col-md-12">
                    <p class="text-center bg-info">
                    <br><br><br>
                    Sin productos
                    <br><br><br>
                    </p>
                </div>
                </div>
                
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
                    <button id="facturaButtonSave" class="btn btn-primary  pull-right"  >
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
 
<!-- Modal - NuevaLine -->
    <div class="modal fade " id="facturaNewForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Buscar Producto</h4>
                    <input type="text" id="facturaNewLineBuscar" placeholder="Buscar" class="form-control"/>
                </div>

                <div class="modal-body">
                    <div id="facturaNewLineBuscarProd" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- // Modal -->


<script type="text/javascript">
$('document').ready(function(){ 
    fact("");
});
</script>

<?php include_once 'template/foot.php';?>
