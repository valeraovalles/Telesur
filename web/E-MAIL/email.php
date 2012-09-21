<?php 
require_once('htmlMimeMail5/htmlMimeMail5.php');
    
    $mail = new htmlMimeMail5();

    $email="jmaderos@telesurtv.net";
     //Establecemos el remitente
    
    $mail->setFrom('webtelesur <webtelesur@telesurtv.net>');
    
    
   //Establecemos el asunto
   
	
    $mail->setSubject('prueba'); 
   
    
     //Establecemos el texto del mensaje de correo
    
    $mail->setHTML("prueba desde licencias");
    
   
//parametros para la salida de correo....
    $mail->setSMTPParams('correo.telesurtv.net', 25, null, true,'jvalera@telesurtv.net', 'contraseña');
	 
    
    // Enviamos el mensaje de correo usando el modo SMTP

    $mail->send(array($email), 'smtp');
	


?>
