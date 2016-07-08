<?php 
//include_once 'dbconfig.php';
  //session_start();
  require_once 'crud/dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
  
  $sql = "SELECT * FROM y_user WHERE user=:uid";
  $stmt=$pdo->prepare($sql);
  $stmt->execute(array(":uid"=>$_SESSION['user_session']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
  $nombre=$row['nombreUsr'];
  $apellido=$row['apellido'];
?>

<!--NavBa-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">Factura Web</a>
    </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li <?=echoActiveClassIfRequestMatches("home")?>>    <a href="home.php">Inicio</a></li>
      <li <?=echoActiveClassIfRequestMatches("client")?>>   <a href="client.php">Clientes</a></li>
      <li <?=echoActiveClassIfRequestMatches("facturas")?>> <a href="facturas.php">Facturas</a></li> 
      <li <?=echoActiveClassIfRequestMatches("pedidos")?>> <a href="pedidos.php">Pedidos</a></li> 
      <li><a href="crud/insertYFactLine.php">Compras</a></li> 
      <li><a href="#">Inventario</a></li> 
      <li><a href="#">Vendedores</a></li> 
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if (  isset($_SESSION['user_session'])):?>
        <!--<div class="session" id="yec">-->
        <li><a href="" id="perfil">
          <span class="glyphicon glyphicon-user"></span><?php echo $nombre;?></a>
        </li>
        <li><a href="" id="logOut">
          <span class="glyphicon glyphicon-log-out"></span>logout</a>
        </li>
      <?php else: ?>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <?php endif; ?>
    </ul>
  </div>
  </div>
</nav>
<!--NavBa-->