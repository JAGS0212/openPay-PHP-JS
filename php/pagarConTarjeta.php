<?php
    include_once("pagosConOpenPay.php");
    $op = new openPayObj("","");
    /*
     * $_POST['token_id']
     * $_POST['ammount']
     * $_POST['nombre']
     * $_POST['deviceIdHiddenFieldName']
     * $_POST['email']
     * $_POST['phone']
     * */

    $ret = $op->pagarConTarjeta($_POST['token_id'],$_POST['ammount'],$_POST['nombre'],$_POST['deviceIdHiddenFieldName'],$_POST['email'],$_POST['phone']);
    print_r($ret);
?>