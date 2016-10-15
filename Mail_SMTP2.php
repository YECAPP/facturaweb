<?


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

$to       = 'yuriernesto@gmail.com';
$from     = 'ventas@profeshop.es';
$subject     = 'Mensaje de POA';

$headers=array( 'To'=>$to,
                'From'=>$from,
                'Subject'=>$subject);

$text='Plain Text Email Content';
$html='HTML Email Content\n';

$attachment="Logo.jpg";

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




?>
