<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/Chat-App/phpmailer/phpmailer/src/Exception.php';
require '/Chat-App/phpmailer/phpmailer/src/PHPMailer.php';
require '/Chat-App/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "pepeperez4609@gmail.com";
$mail->Password   = "pepe1234";
$mail->IsHTML(true);
$mail->AddAddress("shapedlm2020@gmail.com", "Luis");
$mail->SetFrom("fpepeperez4609@gmail.com", "pepe");
$mail->AddReplyTo("reply-to-email@domain", "reply-to-name");
$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";
$mail->MsgHTML($content);
if (!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
} else {
    echo "Email sent successfully";
}
