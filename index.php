<?php session_start();
        if(isset($_SESSION['user_session'])!="")
        {
    	   header("Location: home.php");
        }
    ?>
<?php include_once 'template/head.php';?>

<!--login form  -->

  <div class="wrapper">
    <form class="form-signin" method="post" id="login-form">
        <h2 class="form-signin-heading">
            Iniciar Sesión
        </h2>
        <hr />
        <div id="error">
           <!-- mostrar el error! -->
        </div>
        <div class="row">
            <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="user_email" id="user_email" />
            <span id="check-e"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
            </div>
        </div>
      <!--<label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label>-->
      <div class="row">
            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
                </button> 
            </div>
        </div>
      <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   -->
    </form>
  </div>

<?php include_once 'template/foot.php';?>