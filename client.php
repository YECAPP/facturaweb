<?php  session_start();
  if(!isset($_SESSION['user_session']))
  {
    header("Location: index.php");
  }
?>
<!--Script Sessionstart-->
<!--Incluir funciones-->
<?php include_once 'func.php';?>
<!--Incluir funciones-->
<?php include_once 'template/head.php';?>

<?php include_once 'template/navbar.php';?>

<div class="container">
    <div class="panel panel-primary ycabecera">
    <div class="panel-heading" >
        <div class="row " >
            <div class=" col-xs-12 col-md-12">
                <h3>Clientes</h3>
                <hr>
            </div>
        </div>
        <div class="row ">
            <div class="  col-md-10 ">
                <input type="text" class=" form-control"  placeholder="Introduzca su busqueda" id="textBoxSearch">
            </div>
            <div class=" col-md-2 buttonNuevo">
                <button class="btn btn-default pull-right"  data-toggle="modal" data-target="#newForm" >
                Nuevo 
                <span class="glyphicon glyphicon-plus"  aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row" >
                <div class=" col-xs-12 col-md-12" id="loaded"></div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="row" >
            <div class=" col-md-12 text-right" >
                Clientes        
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Modal - NuevosUsuarios -->
    <div class="modal fade" id="newForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Registro</h4>
                </div>

                <div class="modal-body">
                <div class="row ">
                    <div class="form-group col-md-6">
                        <label for="newNombre">Nombre</label>
                        <input type="text" id="newNombre" placeholder="Nombre" class="form-control"/>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="newApellido">Apellido</label>
                        <input type="text" id="newApellido" placeholder="Apellido" class="form-control"/>
                    </div>
                </div>
                <div class="row ">
                    <div class="form-group col-md-6">
                        <label for="newEmail">Email</label>
                        <input type="text" id="newEmail" placeholder="Email" class="form-control"/>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="newTelefono">Telefono</label>
                        <input type="text" id="newTelefono" placeholder="Telefono" class="form-control"/>
                    </div>
                     <div class="form-group col-md-3">
                        <label for="newCodPost">Código</label>
                        <input type="text" id="newCodPost" placeholder="Código Postal" class="form-control"/>
                    </div>

                </div>
                <div class="row ">
                    
                    <div class="form-group col-md-3">
                        <label for="newCdad">Ciudad</label>
                        <input type="text" id="newCdad" placeholder="Ciudad" class="form-control"/>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="newEstado">Estado</label>
                        <input type="text" id="newEstado" placeholder="Estado" class="form-control"/>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="newDirecc">Direccion</label>
                        <input type="text" id="newDirecc" placeholder="Direccion" class="form-control"/>
                    </div>
                </div>
                <div class="row ">
                    <div class="form-group col-md-4">
                        <label for="newCodigo">Código</label>
                        <input type="text" id="newCodigo" placeholder="Código" class="form-control"/>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="newCodtrib">Código Tributario </label>
                        <input type="text" id="newCodtrib" placeholder="Código Trinutario" class="form-control"/>
                    </div>


                </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="clientNuevoRegistro" class="btn btn-primary" onclick="addClient()">Agregar Registro</button>
                    <input type="hidden" id="newHiddenId">

                </div>
            </div>
        </div>
    </div>
<!-- // Modal -->

<!-- Modal - Actualizar datos -->
    <div class="modal fade" id="updateForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="updateNombre">First Name</label>
                        <input type="text" id="updateNombre" placeholder="First Name" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="updateApellido">Last Name</label>
                        <input type="text" id="updateApellido" placeholder="Last Name" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="updateEmail">Email Address</label>
                        <input type="text" id="updateEmail" placeholder="Email Address" class="form-control"/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="updateClient()" >Guardar Cambios</button>
                    <input type="hidden" id="updateHiddenId">
                </div>
            </div>
        </div>
    </div>
<!-- // Modal -->
<script type="text/javascript">
$('document').ready(function(){ 
    client("");

});

$('#textBoxSearch').keyup(function() {
    client($('#textBoxSearch').val()); 
});


</script>
<?php include_once 'template/foot.php';?>