<?php  session_start();
  if(!isset($_SESSION['user_session']))
  {
    header("Location: index.php");
  }
?>

<!--Incluir funciones-->
<?php include_once 'func.php';?>
<!--Incluir funciones-->
<?php include_once 'template/head.php';?>

 <?php include_once 'template/navbar.php';?>
<!--Incluir barra de navegacion-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="sidebar ">
              <ul class="nav nav-sidebar  navbar-default">
                <li class="active"><a href="#">Inicio <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Reportes</a></li>
                <li><a href="#">Analisis</a></li>
                <li><a href="#">Herramientas</a></li>
              </ul>
            </div> 
        </div>
        <div class="col-sm-7 col-md-10 ">
<!--Estadisticas Titulo-->
            <div class="row">
              <div class=col-md-12>
                <h1 style="color:gray;">Estadisticas</h1>
                <hr>
              </div>
            </div>

<!--Widgets-->
            <div class="row">

              <div class=col-md-3>
                <!--Widgets Clientes-->
                  <div class="widget2">
                    <button type="button" class="btnyec widget">
                      <i class="fa fa-group fa-3x">
                        <div id="widget1">2k </div>
                      </i>
                      <p>Clientes</p>
                    </button>
                  </div> <!--class="btn-group" role="group"-->
              </div> <!--class=col-md-3-->

              <div class=col-md-3>
                  <!--Widgets Facturas-->
                  <div class="widget2">
                    <button type="button" class="btnyec widget">
                      <i class="fa fa-edit fa-3x">
                        <div id="widget2">12k </div>
                      </i>
                      <p>Facturas</p>
                    </button>
                  </div> <!--class="btn-group" role="group"-->
              </div> <!--class=col-md-3-->

              <div class=col-md-3>
                  <!--Widgets Productos-->
                  <div class="widget2">
                    <button type="button" class="btnyec widget">
                      <i class="fa fa-shopping-cart fa-3x">
                        <div id="widget3">2k </div>
                      </i>
                      <p>Productos</p>
                    </button>
                  </div> <!--class="btn-group" role="group"-->
              </div> <!--class=col-md-3-->
              
              <div class=col-md-3>
                  <!--Widgets Vendedores-->
                  <div class="widget2">
                    <button type="button" class="btnyec widget">
                      <i class="fa fa-user fa-3x">
                        <div id="widget4">2k </div>
                      </i>
                      <p>Vendedores</p>
                    </button>
                  </div> <!--class="btn-group" role="group"-->
              </div> <!--class=col-md-3-->
            </div><!--Widgets--> <!--class="row"--> 

<!--Graficas Titulo -->
            <div class="row">
              <div class=col-md-12>
                <h1 style="color:gray;">Gráficas </h1>
                <hr>
              </div>
            </div>

<!--Graficas-->
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <!--contenido-->     

                <div style="width: 500px; height: 300px;">
                  <h3 style="color:gray;">5 Productos mas caros</h3>
                  <hr>
                  <canvas  id="myChart1"></canvas>  
                  <script>
                    target='phpjson/graph1.php';
                    $.post(target,{},function(data, status){
                      //recibe el json formateado 
                      var prod=JSON.parse(data);
                      //declarando variables producto y costo 
                      var producto = [];
                      var costo = [];
                      //ingresando los valores a los arrays 
                      for(var i=0;i<prod.length;i++){
                        
                        producto.push("Prod:" + prod[i].DESCRIP);
                        costo.push(prod[i].COSTO);
                      }

                      //preparando la chardata
                      var chartdata = {
                        labels: producto,
                        datasets : [
                          {
                            label: '5 productos más Caros ',
                            backgroundColor:['rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                ],
                            borderColor:['rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'],
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            borderWidth: 3,
                            data: costo
                          }
                        ]
                      };

                      //capturando el canvas 
                      var ctx = $("#myChart1");
                      //generando la grafica 
                      var barGraph = new Chart(
                        ctx, {
                          type: 'doughnut',
                          data: chartdata
                        }
                      );
                    }); //fin del metodo ajax Post Jquery 

                    //alert(JSON.stringify(data));
                  </script>
                </div> <!--style="width: 500px; height: 300px;"-->
              </div><!--class="col-md-6 col-sm-6"-->

              <div class="col-md-6 col-sm-6">
                <h3 style="color:gray;">5 Productos mas vendidos</h3>
                <hr>
                <div style="width: 500px; height: 300px;">
                  <canvas  id="myChart2"></canvas>  
                  <script>
                    target='phpjson/graph2.php';
                    $.post(target,{},function(data, status){
                      //recibe el json formateado 
                      var prod=JSON.parse(data);
                      //declarando variables producto y costo 
                      var producto = [];
                      var cant = [];
                      //ingresando los valores a los arrays 
                      for(var i=0;i<prod.length;i++){
                        
                        producto.push("Prod:" + prod[i].idprod);
                        cant.push(prod[i].cant);
                      }

                      //preparando la chardata
                      var chartdata = {
                        labels: producto,
                        datasets : [
                          {
                            label: 'productos más Vendidos ',
                            backgroundColor:['rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                ],
                            borderColor:['rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'],
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            borderWidth: 3,
                            data: cant
                          }
                        ]
                      };

                      //capturando el canvas 
                      var ctx = $("#myChart2");
                      //generando la grafica 
                      var barGraph = new Chart(
                        ctx, {
                          type: 'pie',
                          data: chartdata
                        }
                      );
                    }); //fin del metodo ajax Post Jquery 
                  </script>
                </div> <!--style="width: 500px; height: 300px-->
                </div> <!--class="col-md-6 col-sm-6"-->

                

<!--contenido-->

              </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  target='phpjson/widget1.php';
  $.post(target,{},function(data, status){
    
    var widget=JSON.parse(data);
    
    $("#widget1").html(widget[0].valor);
  });
  
  target='phpjson/widget2.php';
  $.post(target,{},function(data, status){
    
    var widget=JSON.parse(data);
    
    $("#widget2").html(widget[0].valor);
  });

  target='phpjson/widget3.php';
  $.post(target,{},function(data, status){
    
    var widget=JSON.parse(data);
    
    $("#widget3").html(widget[0].valor);
  });


  target='phpjson/widget4.php';
  $.post(target,{},function(data, status){
    
    var widget=JSON.parse(data);
    
    $("#widget4").html(widget[0].valor);
  });


</script>


<?php include_once 'template/foot.php';?>