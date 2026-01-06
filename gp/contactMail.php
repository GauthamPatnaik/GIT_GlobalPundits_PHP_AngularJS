<?php
include(__DIR__."/../portal/common/mail.lib.php");
require(__DIR__.'/../portal/vendor/autoload.php');

$post_data = json_decode(file_get_contents("php://input"), true);

$subject = "Message for website visitor";

$message = "Name: ".$post_data['fields']['name']."<br>";
$message .= "Email: ".$post_data['fields']['mail']."<br>";
$message .= "Message: ".$post_data['fields']['message']."<br>";

$mailTo = "gp@globalpundits.com";
$mailer = new sendMail();
$mailer->setTo($mailTo);
$mailer->setContent($subject, $message);
$mailRes = $mailer->send();


$result = json_encode($mailRes);
echo $result;

?>