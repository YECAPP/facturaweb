<?php 

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

function sendFactura($fact,$xmail,$xnomb){
    require_once "Mail.php";
    require_once "Mail/mime.php";


    $host     ='smtp.profeshop.es';
    $username ='ventas@profeshop.es';
    $password ='Vr+m77LJU0ceh283rSPCVl7pnYfawBVwxJ9dXOg9toA';

    $smtp=Mail::factory('smtp',array(
          'host'=>$host,
          'auth'=>true,
          'username'=>$username,
          'password'=>$password));

    $to       = $xmail;
    $from     = 'ventas@profeshop.es';
    $subject     = 'Mensaje de POA';

    $headers=array( 'To'=>$to,
                    'From'=>$from,
                    'Subject'=>$subject);

    $text='Plain Text Email Content';
    $html='HTML Email Content\n';

    $attachment=$fact;

    $mime= new Mail_mime();
    $mime->setTXTBody($text);
    $mime->setHTMLBody($html);
    $mime->addAttachment($attachment,'image/jpeg');

    $body=$mime->get();
    $headers=$mime->headers($headers);

    $mail=$smtp->send($to,$headers,$body);

    if(PEAR::isError($mail)){
      echo $mail-getMessage();
    }else{
      echo "Message sent";
    }


}

function selectTasas($x) {
 	//Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="DESCRIP, ";
    $sql.="VALOR ";
    $sql.="FROM y_param ";
    $sql.="WHERE TP=1 ";
    
    $selectTasasData="";
    
    require 'crud/dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

    foreach ($pdo->query($sql) as $row) 
    {	
        if ($row['VALOR']==$x){
            $selectTasasData.='<option selected value="'.$row['VALOR'].'">'.$row['VALOR'].'%'.'</option>';    
        }else{
            $selectTasasData.='<option value="'.$row['VALOR'].'">'.$row['VALOR'].'%'.'</option>';    
        }
        

    	
    }

    $pdo=null;
    return  $selectTasasData;
}
?>