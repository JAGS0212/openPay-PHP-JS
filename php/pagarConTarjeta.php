<?php
    include_once("pagosConOpenPay.php");
    include_once("mailer.php");

    $op = new openPayObj("",""); //idMercader,idPrivado
   
    $senderMail = ""; //My email
    $senderPass = ""; //My Pass;


    /*
     *
     * $_POST['token_id']
     * $_POST['ammount']
     * $_POST['nombre']
     * $_POST['deviceIdHiddenFieldName']
     * $_POST['email']
     * $_POST['phone']
     * */

    $ret = $op->pagarConTarjeta($_POST['token_id'],$_POST['ammount'],$_POST['nombre'],$_POST['deviceIdHiddenFieldName'],$_POST['email'],$_POST['phone']);
    if($ret["status"] < 0){
        print_r($ret["error"]);
        print_r("La generación del pago falló, esto es normal para pagos con tarjeta en versión de debug en openPay. Debería de hacer el cargo correctamente en versión de producción");
        return;
    }
    else{
        $bodyHtml = '<h1>El cargo a tu tarjeta ha sido exitoso!</h1><bold>Para cualquier duda o aclaración comunicate a los teléfonos: 33-33663465 ó 33-76554345</bold>';
        $body = "El cargo a tu tarjeta ha sido exitoso! Para cualquier duda o aclaración comunicate a los teléfonos: 33-33663465 ó 33-76554345"; //Porque dos veces? y Porque sin html? Este mensaje es un respaldo en caso de que el correo del receptor no soporte la recepción de correos estructurados con HTML

        $receiverMail = $_POST['email'];
        $res = $mailer->sendMail($receiverMail,'Equipo Luxline','Cargo exitoso',$bodyHtml,$body,'',0);
        if((int)$res["status"] < 0){
            print_r($res["error"]);
            print_r("Pago realizado correctamente y fallo el envio de correo, checa que tengas instalado OpenSSL en tu instalación de php");
        }
        else{
            print_r("Pago generado y mensaje enviado correctamente");
        }
    }
?>