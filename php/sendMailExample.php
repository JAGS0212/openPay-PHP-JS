<?php
include_once("mailer.php");
$bodyHtml = '<h1>This is just a test</h1><bold>I love the way this looks!</bold>';
$body = "This is just a test. I love the way this looks"; //Porque dos veces? y Porque sin html? Este mensaje es un respaldo en caso de que el correo del receptor no soporte la recepción de correos estructurados con HTML
$senderMail = ""; //Mail del emisor
$senderPass = ""; //Contraseña del mail del emisor
$receiverMail = ""; //Mail del receptor
$attachmentPath  = "../img/test.jpg"; //Archivo adjunto

$mailer = new phpMailerWithGmail($senderMail,$senderPass,'Jorge');

print_r($mailer->sendMail($receiverMail,'Jorge','Email de prueba',$bodyHtml,$body)); //Debug
$receiverMail = "i44_jorge@hotmail.com";
print_r($mailer->sendMail($receiverMail,'Jorge','Email de prueba',$bodyHtml,$body,$attachmentPath,0));//Release

?>