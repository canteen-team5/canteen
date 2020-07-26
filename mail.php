<?php
echo "h1";
/*use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->isSMTP();
$mail->SMTPDebug = 3;
$mail->Host = 'localhost'; //'relay-hosting.secureserver.net' didn't work
$mail->Port = 80;
$mail->SMTPAuth = false;
$mail->SMTPSecure = false;
$mail->SMTPAutoTLS = false;


$mail->setFrom('rajat18111999@gmail.com', 'no-name'); // Add a sender
$mail->addAddress('rs9404632@gmail.com'); // Add a recipient
$mail->isHTML(true);                      // Set email format to HTML
$mail->Subject = 'Test Email';
$mail->Body    = 'Some body';
$mail->CharSet = 'utf-8';
$mail->AltBody = 'alt body';

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //http_response_code(204);
}*/

require("PHPMailer/src/PHPMailer.php");
  require("PHPMailer/src/SMTP.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "rajat18111999@gmail.com";
    $mail->Password = "2552@rajat&";
    $mail->SetFrom("xxxxxx@xxxxx.com");
    $mail->Subject = "Test";
    $mail->Body = "hello";
    $mail->AddAddress("rs97404632@gmail.com");

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }

?>