<?php
require(__DIR__.'/../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class sendMail {
  var $mail = "";
  
  function __construct() {
    $this->mail = new PHPMailer(true);
    $this->mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $this->mail->isSMTP();                                      // Set mailer to use SMTP
    $this->mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
    $this->mail->Username = 'hr@globalpundits.com';                 // SMTP username
    $this->mail->Password = 'Gpundits5$';                           // SMTP password
    $this->mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $this->mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $this->mail->setFrom('hr@globalpundits.com', 'Globalpundits HR');
    $this->mail->addReplyTo('hr@globalpundits.com', 'HR');  
  }
  
  function setTo($to) {
    if (is_array($to)) {
      foreach ($to as $x) {
        $this->mail->addAddress($x);
      }
    } else {
      $this->mail->addAddress($to);
    }
  }
  
  function setCC($cc) {
    if (is_array($cc)) {
      foreach ($cc as $x) {
        $this->mail->addAddress($x);
      }
    } else {
      $this->mail->addAddress($cc);
    }
  }
  
  function setBCC($bcc) {
    if (is_array($bcc)) {
      foreach ($bcc as $x) {
        $this->mail->addAddress($x);
      }
    } else {
      $this->mail->addAddress($bcc);
    }
  }
  
  function setContent($subject, $body, $html=true) {
    $this->mail->isHTML($html);                                  // Set email format to HTML
    $this->mail->Subject = $subject;
    $this->mail->Body    = $body;
  }
  
  function send() {
    try {
      $this->mail->send();

      $response = [];
      $response['status'] = true;
      $response['message'] = 'Email has been sent';

      return $response;
    } catch(Exception $e) {
      $response = [];
      $response['status'] = false;
      $response['message'] = 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo;

      return $response;
    }
  }
}

class emailTemplate {
  var $mailBody = "";
  
   function __construct() {
     $this->mailBody = file_get_contents(__DIR__."/../templates/standard_mail.html");
   }
  
  function setHeading($heading) {
    $this->mailBody = str_replace("{!heading}", $heading, $this->mailBody);
  }
  
  function setBody($body) {
    $this->mailBody = str_replace("{!body}", $body, $this->mailBody);
  }
  
  function getTemplate() {
    return $this->mailBody;
  }
}

?>