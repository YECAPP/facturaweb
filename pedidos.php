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
    <div class="ycabecera ">
        <div class="row " >
            <div class=" col-xs-12 col-md-12">
                <h3>Pedidos</h3>
            </div>
        </div>
        <div class="row ">
            <div class=" col-xs-12 col-md-9 searchText">
                <input type="text" class=" form-control" size="60" placeholder="Introduzca su busqueda" id="textBoxSearch">
            </div>
            <div class=" col-xs-12 col-md-1">
                <button class="btn btn-primary" id="buttonLoad"  data-toggle="modal">
                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                Cargar
                </button>
            </div>
            <div class="col-xs-12 col-md-2">
                <button class="btn btn-success"  data-toggle="modal" data-target="#newForm" >
                <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                Nuevo Registro
                </button>
            </div>
        </div>
    </div>
    <div class="row" >
            <div class=" col-xs-12 col-md-12" id="loaded"></div>
    </div>
</div>

<!-- Modal - NuevosUsuarios -->
    <div class="modal fade" id="newForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Registro</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="newNombre">Nombre</label>
                        <input type="text" id="newNombre" placeholder="Nombre" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="newApellido">Apellido</label>
                        <input type="text" id="newApellido" placeholder="Apellido" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="newEmail">Email</label>
                        <input type="text" id="newEmail" placeholder="Email" class="form-control"/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="addClient()">Agregar Registro</button>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="updateClient()" >Save Changes</button>
                    <input type="hidden" id="updateHiddenId">
                </div>
            </div>
        </div>
    </div>
<!-- // Modal -->
<?php include_once 'template/foot.php';?>