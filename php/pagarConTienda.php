<?php

include_once("pagosConOpenPay.php");


$op = new openPayObj("","");

$monto = $_POST["monto"];
$nombreCliente = $_POST["nombreCliente"];
$apellidosCliente = $_POST["apellidosCliente"];
$email = $_POST["email"];
$descripcion = "Pago en tiendas";
$res = $op->pagarEnTienda($monto,$descripcion,$nombreCliente,$apellidosCliente,$email);
print_r($res);

?>