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
                    <h3>Vendedores</h3>
                    <hr>
                </div>
            </div>
            <div class="row ">
                <div class=" col-md-10 ">
                    <input type="text" class=" form-control"  placeholder="Introduzca su busqueda" id="textVendorBoxSearch">
                </div>

                <div class=" col-md-2 buttonNuevo">
                    <button class="btn btn-default pull-right" id="vendorNuevoRegistro"  data-toggle="modal" data-target="#vendorNewForm" >
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
                Vendedores        
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Modal - NuevosVendors -->
    <div class="modal fade" id="vendorNewForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Registro</h4>
                </div>
            <form id="vendorform">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newnombreUsr">Nombre  </label>
                        <input type="text" id="newnombreUsr" placeholder="Nombre" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="newapellido">Apellido</label>
                        <input type="text" id="newapellido" placeholder="Apellido" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="newuser">Login</label>
                        <input type="text" id="newuser" placeholder="Login" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="newpwd">Password</label>
                        <input type="password" id="newpwd" placeholder="Password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="newidRol">Idrol</label>
                        <select class="form-control" id="newidRol">
                            <?php include_once 'crud/vendorSelectTag.php'; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="vendorNewFormButtonSubmit"          onclick="addVendor()">Agregar Registro</button>
                    <input type="hidden" id="updateHiddenId" />
                </div>
            </form>
            </div>
        </div>
    </div>
<!-- // Modal -->


<!--Sección  productos-->
<script type="text/javascript">
//buscar prod
    $('document').ready(function(){ 
        vendor("");
   
    $("#vendorform").validate({
    rules: {
        newnombreUsr: {
            required: true,
        },
        newapellido: {
            required: true,
        }
    },
    messages: {
        newnombreUsr: "Nombre nuevo",
        newapellido: "apellido nuevo",
    },
    submitHandler: function() {
      alert("formulario enviado");
    }
  });

    });







    $('#vendorNuevoRegistro').click(function(){
        //$('#prodNewForm').modal("show");

       $("#vendorNewFormButtonSubmit").attr("onclick","addVendor()")
       $("#vendorNewFormButtonSubmit").text("Nuevo");
    });

    //Realizar busqueda en el textbox
    $('#textVendorBoxSearch').keyup(function() {
        vendor(" ");
    });

    function addVendor(){
        nombreUsr=$("#newnombreUsr").val();
        apellido=$("#newapellido").val();
        user=$("#newuser").val();
        pwd=$("#newpwd").val();
        idRol=$("#newidRol").val();
        

        target="crud/insertYVendor.php";

        $.post(target,{
            nombreUsr:nombreUsr,
            apellido:apellido,
            user:user,
            pwd:pwd,
            idRol:idRol
        },function(data,status){
            $("#vendorNewForm").modal("hide");
            alert(data);
            vendor();
            
            $("#newnombreUsr").val("");
            $("#newapellido").val("");
            $("#newuser").val("");
            $("#newpwd").val("");
            $("#newidRol").val("");
            
        })
    }

    function deleteVendor(id){
         
        var conf=confirm("Seguro de borrar");
        if (conf==true){
            $.post("crud/delYVendor.php",{id:id},
                function(data,status){ 
                    vendor();
            });
        }
    }

    function loadVendorData(idvendor){

        $("#updateHiddenId").val(idvendor);

        target="crud/loadYVendor.php";

        $.post(target,{id:idvendor},function(data,status){
            
            var vendor=JSON.parse(data);

            $("#newnombreUsr").val(vendor.nombreUsr);
            $("#newapellido").val(vendor.apellido);
            $("#newuser").val(vendor.user);
            $("#newpwd").val(vendor.pwd);
            $("#newidRol").val(vendor.idRol);
            $("#newalta").val(vendor.alta);  

        });

        $("#vendorNewForm").modal("show");
        $("#vendorNewFormButtonSubmit").attr("onclick","updateVendor()");
        $("#vendorNewFormButtonSubmit").text("Cambiar");

    }


    function updateVendor(){
        var idvendor=$("#updateHiddenId").val();
        var nombreUsr=$("#newnombreUsr").val();
        var apellido=$("#newapellido").val();
        var pwd=$("#newpwd").val();
        var user=$("#newuser").val();
        var idRol=$("#newidRol").val();
        
        target="crud/updateYVendor.php";
        $.post(target,{
            id:idvendor,
            nombreUsr:nombreUsr,
            apellido:apellido,
            pwd:pwd,
            user:user,
            idRol:idRol
            },function(data,status){

                $("#updateHiddenId").val("");
                $("#newnombreUsr").val("");
                $("#newapellido").val("");
                $("#newpwd").val("");
                $("#newuser").val("");
                $("#newidRol").val("");            
            
            $("#vendorNewForm").modal("hide"); 
            vendor();   
        });
    }

    function vendor(str,pag) {

        if (str === undefined || str.trim()==""){
            str=$('#textVendorBoxSearch').val();
        }
        
        if (pag === undefined){
            pag=1;
        }

        var target="crud/vendor.php?q="+str+"&pagina="+pag;
        $.get( target, {}, function (data, status) {
            $("#loaded").html(data);
        });
    }

</script>
<!--Sección  productos-->

<?php include_once 'template/foot.php';?>