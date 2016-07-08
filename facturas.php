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
        <div class="ycabecera">
            <div class="row " >
                <div class="col-md-12">
                    <h3>Facturas</h3>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-9 ">
                    <input type="text" class=" form-control"  placeholder="Introduzca su busqueda" id="textFacturaBoxSearch">
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary" id="facturaButtonLoad"  data-toggle="modal">
                    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                    Cargar
                    </button>
                </div>
                <div class="col-md-2">
                    <button id="facturaButtonNew" class="btn btn-success"   >
                    <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                    Nueva Factura
                    </button>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12" id="loaded">
            </div>
        </div>
    <!--ycabecera-->
    <!--ylist-->
        <div class="ydetail">
            <div class="modal-header">
                <button id="facturaButtonSave" class="btn btn-info"  >
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    Guardar Factura
                    </button>
                <button id="facturaButtonNewClose" type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Nueva Factura</h4>
            </div>        
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="facturaNewNumero">Numero</label>
                        <input type="text" id="facturaNewNumero" placeholder="Número Factura" class="form-control"/>
                    </div>
                    <div class="form-group col-md-9">
                        <div class="form-group col-md-10">
                            <label for="facturaNewIdcliente">Cliente</label>
                            <select class="form-control" id="facturaNewIdcliente">
                                <?php include_once 'crud/clientSelectTag.php'; ?>
                            </select>
                        </div>    
                    </div>
                    
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="facturaNewFecha">Fecha</label>
                        <input type="text" id="facturaNewFecha" placeholder="Last Name" class="form-control"/>
                        
                    </div>
                    <div class="form-group col-md-2">
                        <label for="facturaNewIdVendedor">Vendedor</label>
                           <select class="form-control" id="facturaNewIdVendedor">
                                <option value="Vendedor 1">Vendedor 1 </option>
                                <option value="Vendedor 2">Vendedor 2 </option>
                           </select>
                        <!--<input type="text" id="facturaNewIdVendedor" placeholder="Last Name" class="form-control"/>-->
                    </div>
                    <div class="form-group col-md-8">
                        <label for="facturaNewDescrip">Descripción</label>
                        <input type="text" id="facturaNewDescrip" placeholder="Descripción" class="form-control"/>
                    </div>
                </div>
                <div class="row">
                    <!--<button id="facturaButtonNewLine"   class="btn btn-success"  >-->
                    
                    <button class="btn btn-success"  data-toggle="modal" data-target="#facturaNewForm" >
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    Nuevo Producto
                    </button>
                    <input type="hidden" id="facturaNewHidden">
                </div>
                <div class="row" id="facturaLine">
                    
                </div>
            </div>
        </div>
    <!--ylist-->
    </div>
 
<!-- Modal - NuevaLine -->
    <div class="modal fade" id="facturaNewForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <!--<button type="button" class="btn btn-primary" onclick="">Agregar Registro</button>-->
                </div>
            </div>
        </div>
    </div>
<!-- // Modal -->


<!-- Modal - update -->
    <div class="modal fade" id="updateForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="addClient()">Agregar Registro</button>
                    <button type="button" class="btn btn-primary" >Agregar Registro</button>
                </div>
            </div>
        </div>
    </div>
<!-- // Modal -->

<?php include_once 'template/foot.php';?>
