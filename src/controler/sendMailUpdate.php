<?php

require '../PHPmailer/src/Exception.php';
require '../PHPmailer/src/PHPMailer.php';
require '../PHPmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Mailer = "smtp";                   // Set mailer to use SMTP 

$mail->SMTPDebug = 1;                     // Enable verbose debug output
$mail->SMTPAuth = TRUE;                   // Enable SMTP authentication
$mail->SMTPSecure = "tls";                // Enable TLS encryption, 'ssl' (a predecessor to TSL) is also accepted
$mail->Port = 587;                        // TCP port to connect to (587 is a standard port for SMTP)
$mail->Host = "smtp.gmail.com";           // Specify main and backup SMTP servers
$mail->Username = "samenjoysprl@gmail.com";  // SMTP username
$mail->Password = 'spomexeuusojsodb';         // SMTP password 

$mail->setFrom('samenjoysprl@gmail.com', 'Hicking Project');
$mail->addAddress($_SESSION['mail'], 'name-is-optional');

$mail->isHTML(true);                      // Set email format to HTML
$mail->Subject = 'Thanks for your update';
$mail->Body    = 'Vos modifications ont bien été enregistrées';

$mail->send();
