<?php
 session_start();
 require_once 'crud/dbconfig.php';
//include("database.php");
//$db_con = Database::connect();
//Database::connect();

 if(isset($_POST['btn-login']))
 {
  $user_email = trim($_POST['user_email']);
  $user_password = trim($_POST['password']);
  //$password = md5($user_password);
  $password = $user_password;
  
  try
  { 
  
   //$stmt = $pdo->prepare("SELECT * FROM y_user WHERE user=:email");
  $stmt = $pdo->prepare("SELECT * FROM y_user WHERE user=:email");
    
  //$stmt = Database::$cont->prepare("SELECT * FROM y_user WHERE user=:email");
   $stmt->execute(array(":email"=>$user_email));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $count = $stmt->rowCount();
   
   if($row['pwd']==$password){
      $_SESSION['user_session'] = $row['user'];    
      //echo "ok"; // log in
      echo "ok"; // log in
   }
   else{
    
      echo "Correo no existe."; // wrong details 
   }
    
  }
  catch(PDOException $e){
   echo $e->getMessage();
  }
 }

?>