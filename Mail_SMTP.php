<?

error_reporting( E_ALL & ~( E_NOTICE | E_STRICT | E_DEPRECATED ) );
require_once "Mail.php";
require_once "Mail/mime.php";

$to       = 'yuriernesto@gmail.com';
$from     = 'ventas@profeshop.es';
$body     = 'Mensaje de POA';
$host     = 'smtp.profeshop.es';

$username = 'ventas@profeshop.es';
$password = 'Vr+m77LJU0ceh283rSPCVl7pnYfawBVwxJ9dXOg9toA';
$subject  = 'Mensaje de prueba desde POA';


$headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo "Mensaje enviado desde POA a ". $to ;
  }


?>
