<?php

require 'PHPMailer/PHPMailerAutoload.php';

$logFile = 'mailer.log';

$to = $_POST["to"];
$subject = $_POST["subject"];
$body = $_POST["message"];

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'mail.simula.com.tw';
$mail->SMTPAuth = true;
$mail->Username = 'sales';
$mail->Password = 'sim123456';
$mail->Port = 25;
$mail->SMTPSecure = '';
$mail->SMTPAutoTLS = false;

$mail->setFrom('sales@simula.com.tw', 'Simula');
$mail->addAddress($to);
$mail->addReplyTo('sales@simula.com.tw');
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

$mail->Subject = $subject;
$mail->MsgHTML($body);

$log = '';
if(!$mail->send()) {
	$log = 'Message could not be sent.' . 'Mailer error: ' . $mail->ErrorInfo;
} else {
	$log = 'Message sent';
}
$txt = $txt . "\r\n";

fopen($logFile, 'a');
fwrite($myfile, $log);
fclose($myfile);