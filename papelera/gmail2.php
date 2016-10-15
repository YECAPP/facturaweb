<?php

	$idfactura=595;
	$email2Send="yuriernesto@gmail.com";
	$lcFilePdf2Send="factura".$idfactura.".pdf";
	
 
	date_default_timezone_set('Etc/UTC');

	require 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "yecgames2@gmail.com";	
	$mail->Password = 'yecyecyecyec';	
	$mail->setFrom('yecgames2@gmail.com', 'FacturaWeb');
	$mail->addReplyTo('yecgames2@gmail.com', 'FacturaWeb');
	$mail->addAddress($email2Send, 'Yec');
	$mail->Subject = 'Envio de Factura ';
	$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	$mail->AltBody = 'This is a plain-text message body';
	$mail->addAttachment($lcFilePdf2Send);
	
	if (!$mail->send()) {
    	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
    	echo $lcFilePdf2Send." correo <br>";
    	echo $email2Send." Enviado";
	}

	