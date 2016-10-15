<?php 
//include_once 'dbconfig.php';
  //session_start();
  require_once 'crud/dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
  
  // $sql = "SELECT * FROM y_user WHERE user=:uid";
  // $stmt=$pdo->prepare($sql);
  // $stmt->execute(array(":uid"=>$_SESSION['user_session']));
  // $row=$stmt->fetch(PDO::FETCH_ASSOC);
  // $nombre=$row['nombreUsr'];
  // $apellido=$row['apellido'];

?>

<!--NavBa-->
<nav class="navbar  navbar-default" >
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">
        <span class="glyphicon glyphicon-credit-card" aria-hidden="true"> FacturaWeb </span></a>

    </div>
  <div class="collapse navbar-collapse "  id="myNavbar">
  <?php if ( $_SESSION['idRol_session']==1):?>
    <ul class="nav navbar-nav">
      <li <?=echoActiveClassIfRequestMatches("home")?>> 
        <a href="home.php">
          <span class="glyphicon glyphicon-home" aria-hidden="true"> Inicio</span>
        </a>
      </li>
  
      <li <?=echoActiveClassIfRequestMatches("client")?>>   
        <a href="client.php">
          <i class="fa fa-group"> Clientes</i>
        </a>
      </li>
      <li <?=echoActiveClassIfRequestMatches("facturas")?>> 
        <a href="facturas.php">
          <i class="fa fa-edit"> Facturas</i>
        </a>
      </li> 
      <li <?=echoActiveClassIfRequestMatches("prod")?>> 
        <a href="prod.php">
          <i class="fa fa-shopping-cart"> Productos</i>
        </a>
      </li> 
      <li <?=echoActiveClassIfRequestMatches("vendor")?>>
        <a href="vendor.php">
          <i class="fa fa-user"> Vendedores</i>
        </a></li> 
    </ul>
  <?php else: ?>
      <ul class="nav navbar-nav">
      <li <?=echoActiveClassIfRequestMatches("home")?>> 
        <a href="home.php">
          <span class="glyphicon glyphicon-home" aria-hidden="true"> Inicio</span>
        </a>
      </li>
  
      <li <?=echoActiveClassIfRequestMatches("client")?>>   
        <a href="client.php">
          <i class="fa fa-group"> Clientes</i>
        </a>
      </li>
      <li <?=echoActiveClassIfRequestMatches("facturas")?>> 
        <a href="facturas.php">
          <i class="fa fa-edit"> Facturas</i>
        </a>
      </li> 
      <li <?=echoActiveClassIfRequestMatches("prod")?>> 
        <a href="prod.php">
          <i class="fa fa-shopping-cart"> Productos</i>
        </a>
      </li>   
    </ul>
  <?php endif; ?>


    
    <ul class="nav navbar-nav navbar-right">
      <?php if (  isset($_SESSION['user_session'])):?>
        <!--<div class="session" id="yec">-->
        <li><a href="" id="perfil">
          <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['nombreUsr_session'];?></a>
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