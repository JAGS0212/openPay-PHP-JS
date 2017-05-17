<?php

include_once("pagosConOpenPay.php");


$op = new openPayObj("mxnx5ol3qwf9q9y82pp3","sk_97e806e48550464cabbca7bd77255788");

$monto = $_POST["monto"];
$nombreCliente = $_POST["nombreCliente"];
$apellidosCliente = $_POST["apellidosCliente"];
$email = $_POST["email"];
$descripcion = "Pago en tiendas";
$res = $op->pagarEnTienda($monto,$descripcion,$nombreCliente,$apellidosCliente,$email);
print_r($res);

?>