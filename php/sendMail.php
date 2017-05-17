<?php
include_once("mailer.php");
$bodyHtml = '<h1>This is just a test</h1><bold>I love the way this looks!</bold>';
$body = "This is just a test. I love the way this looks";
$senderMail = "a11310180ceti@gmail.com";
$senderPass = "P97KdmAC";
$receiverMail = "a11310180ceti@gmail.com";

$mailer = new phpMailerWithGmail($senderMail,$senderPass,'Jorge');

print_r($mailer->sendMail($receiverMail,'Jorge','Email de prueba',$bodyHtml,$body)); //Debug
$receiverMail = "i44_jorge@hotmail.com";
print_r($mailer->sendMail($receiverMail,'Jorge','Email de prueba',$bodyHtml,$body,0));//Release

?>