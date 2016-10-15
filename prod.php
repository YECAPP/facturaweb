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
                    <h3>Productos</h3>
                    <hr>
                </div>
            </div>
            <div class="row ">
                <div class=" col-md-10 ">
                    <input type="text" class=" form-control"  placeholder="Introduzca su busqueda" id="textProdBoxSearch">
                </div>

                <div class=" col-md-2 buttonNuevo">
                    <button class="btn btn-default pull-right" id="prodNuevoRegistro"  data-toggle="modal" data-target="#prodNewForm" >
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
                Productos        
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Modal - NuevosProductos -->
    <div class="modal fade" id="prodNewForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <label for="newCod">Código </label>
                        <input type="text" id="newCod" placeholder="Código" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="newDescrip">Descripción</label>
                        <input type="text" id="newDescrip" placeholder="Descripción" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="newMarca">Marca</label>
                        <input type="text" id="newMarca" placeholder="Marca" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="newModelo">Modelo</label>
                        <input type="text" id="newModelo" placeholder="Modelo" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="newCosto">Costo</label>
                        <input type="text" id="newCosto" placeholder="Costo" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="newPrecio">Precio</label>
                        <input type="text" id="newPrecio" placeholder="Precio" class="form-control"/>
                    </div>
                    <div class="form-group">

                        <select class="form-control" id="newTax">
                            <?php include_once 'crud/taxSelectTag.php'; ?>
                        </select>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="prodNewFormButtonSubmit" onclick="addProd()">Agregar Registro</button>
                    <input type="hidden" id="updateHiddenId" />
                </div>
            </div>
        </div>
    </div>
<!-- // Modal -->


<!--Sección  productos-->
<script type="text/javascript">
//buscar prod
    $('document').ready(function(){ 
        prod("");
    });

    $('#prodNuevoRegistro').click(function(){
        //$('#prodNewForm').modal("show");
       $("#prodNewFormButtonSubmit").attr("onclick","addProd()")
       $("#prodNewFormButtonSubmit").text("Nuevo");
    });

    $('#textProdBoxSearch').keyup(function() {
        prod(" "); 
    });


    function addProd(){
        
        codigo=$("#newCod").val();
        descrip=$("#newDescrip").val();
        marca=$("#newMarca").val();
        modelo=$("#newModelo").val();
        costo=$("#newCosto").val();
        precio=$("#newPrecio").val();
        tax=$("#newTax").val();

        target="crud/insertYProd.php";

        $.post(target,{
            codigo:codigo,
            descrip:descrip,
            marca:marca,
            modelo:modelo,
            costo:costo,
            precio:precio,
            tax:tax
        },function(data,status){
            $("#prodNewForm").modal("hide");
            prod();
            
            $("#newCod").val("");
            $("#newDescrip").val("");
            $("#newMarca").val("");
            $("#newModelo").val("");
            $("#newCosto").val("");
            $("#newPrecio").val("");
            $("#newTax").val("");
        })
    }

    function deleteProd(id){
        var conf=confirm("Seguro de borrar");
        if (conf==true){
            $.post("crud/delYProd.php",{id:id},function(data,status){ prod();});
        }
    }

    function loadProdData(idprod){
        $("#updateHiddenId").val(idprod);

        target="crud/loadYProd.php";

        $.post(target,{id:idprod},function(data,status){
            
            var prod=JSON.parse(data);
            
            $("#newCod").val(prod.CODIGO);
            $("#newDescrip").val(prod.DESCRIP);
            $("#newMarca").val(prod.MARCA);
            $("#newModelo").val(prod.MODELO);
            $("#newCosto").val(prod.COSTO);
            $("#newPrecio").val(prod.PRECIO);  
            $("#newTax").val(Number(prod.TAX)); 

        });

        $("#prodNewForm").modal("show");
        $("#prodNewFormButtonSubmit").attr("onclick","updateProd()");
        $("#prodNewFormButtonSubmit").text("Cambiar");
    }


    function updateProd(){
        var idprod=$("#updateHiddenId").val();
        var codigo=$("#newCod").val();
        var descrip=$("#newDescrip").val();
        var marca=$("#newMarca").val();
        var modelo=$("#newModelo").val();
        var costo=$("#newCosto").val();
        var precio=$("#newPrecio").val();
        var tax=$("#newTax").val();

        target="crud/updateYProd.php";
        $.post(target,{
            id:idprod,
            codigo:codigo,
            descrip:descrip,
            marca:marca,
            modelo:modelo,
            costo:costo,
            precio:precio,
            tax:tax
            },function(data,status){
                $("#newCod").val("");
                $("#newDescrip").val("");
                $("#newMarca").val("");
                $("#newModelo").val("");
                $("#newCosto").val("");
                $("#newPrecio").val("");
                $("#newTax").val("");

                $("#prodNewForm").modal("hide"); 
                prod();   
            });
    }

    function prod(str,pag) {
        if (str === undefined || str.trim()==""){
            str=$('#textProdBoxSearch').val();
        }
        
        if (pag === undefined){
            pag=1;
        }

        var target="crud/prod.php?q="+str+"&pagina="+pag;
        $.get( target, {}, function (data, status) {
            $("#loaded").html(data);
        });
    }


</script>
<!--Sección  productos-->


<?php include_once 'template/foot.php';?>