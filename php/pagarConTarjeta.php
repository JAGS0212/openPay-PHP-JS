<?php
    include_once("pagosConOpenPay.php");
    $op = new openPayObj("mxnx5ol3qwf9q9y82pp3","sk_97e806e48550464cabbca7bd77255788");
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