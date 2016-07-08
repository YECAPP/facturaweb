<?php session_start();
        if(isset($_SESSION['user_session'])!="")
        {
    	   header("Location: home.php");
        }
    ?>
<?php include_once 'template/head.php';?>
<!--login form  -->
    <div class="signin-form">
    	<div class="container">
           <form class="form-signin" method="post" id="login-form">
                <h2 class="form-signin-heading">Log In to WebApp.</h2><hr />
                <div id="error">
                <!-- error will be shown here ! -->
                </div>
            
            <div class=" col-xs-12 form-group">
                <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
                <span id="check-e"></span>
            </div>
            
            <div class=" col-xs-12 form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
            </div>
         	<hr />
            <div class=" col-xs-12 form-group">
                <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
        		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
    			</button> 
            </div>  
          </form>
        </div>
    </div>
    
<?php include_once 'template/foot.php';?>