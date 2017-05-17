<?php
include_once("pagosConOpenPay.php");
include_once("mailer.php");

$op = new openPayObj("",""); //idMercader, idPrivado
$senderMail = ""; //My email
$senderPass = ""; //My Pass;


$monto = $_POST["monto"];
$nombreCliente = $_POST["nombreCliente"];
$apellidosCliente = $_POST["apellidosCliente"];
$email = $_POST["email"];
$descripcion = "Pago en tiendas";


$res = $op->pagarEnTienda($monto,$descripcion,$nombreCliente,$apellidosCliente,$email);
if($res["status"] < 0){
    print_r($res["error"]);
    print_r("La generaci�n del pago fall�, checa que tengas instalado cURL en tu instalaci�n de php");
    return;
}
else{

    $bodyHtml = '<h1>Felicidades! Hemos procesado tu compra.</h1><bold>Para liquidar tu compra haz click <a href="'.$res["receipt"].'">aqui</a> y descargar tu forma y realiza el pago en cualquiera de nuestras tiendas afiliadas. </bold>';
    $body = 'Felicidades! Hemos procesado tu compra. Para liquidar tu compra haz copia y pega esta liga '.$res["receipt"].', descargar t� forma y realiza el pago en cualquiera de nuestras tiendas afiliadas.'; //Porque dos veces? y Porque sin html? Este mensaje es un respaldo en caso de que el correo del receptor no soporte la recepci�n de correos estructurados con HTML
    $receiverMail = $_POST["email"];
    $mailer = new phpMailerWithGmail($senderMail,$senderPass,'Equipo Luxline');
    $res = $mailer->sendMail($receiverMail,'Equipo Luxline','Descarga tu forma de pago',$bodyHtml,$body,'',0);
    if((int)$res["status"] < 0){
        print_r($res["error"]);
        print_r("Pago realizado correctamente y fallo el envio de correo, checa que tengas instalado OpenSSL en tu instalaci�n de php");
    }
    else{
        print_r("Pago generado y mensaje enviado correctamente");
    }
}


?>