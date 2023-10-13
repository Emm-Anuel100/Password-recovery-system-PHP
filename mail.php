<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

   require('./PHPMailer/src/Exception.php');
   require('./PHPMailer/src/PHPMailer.php');
   require('./PHPMailer/src/SMTP.php');


  function send_mail($recipient,$subject,$message)
  {
   
   $mail = new PHPMailer(true);
   $mail->IsSMTP(); // enable SMTP
   $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
   //authentication SMTP enabled
   $mail->SMTPAuth = true; 
   $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
   $mail->Host = "smtp.gmail.com";
   
   //use Gmail 465 or 587
   $mail->Port = 587; 
   $mail->Username = "emmanuelodel75@gmail.com";
   // $mail->Password = "qmzaxjodrnccnegn";
   // $mail->Password = "Iamemmy2003";
   $mail->Password = "vjrqqxfbhcjbgufo";

   $mail->ISHTML(true);
   $mail->AddAddress($recipient, "esteemed user"); 
   $mail->SetFrom("emmanuelodel75@gmail.com", "Goo");
   $mail->Subject = $subject;
   $content = $message; 

   $mail->MsgHTML($content);
   if(!$mail->Send()) {
   // echo "Mailer Error: " . $mail->ErrorInfo;
   return false;
   } else {
   // echo "Message has been sent";
   return true;
   }
   }
?>