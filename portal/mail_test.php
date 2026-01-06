<?php
include("./common/db.lib.php");
include("./common/session.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];

if (checkSession($id, $session_key)){
  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
  try {
      //Server settings
      $mail->SMTPDebug = 0;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'hr@globalpundits.com';                 // SMTP username
      $mail->Password = 'Gpundits5$';                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('hr@globalpundits.com', 'Globalpundits HR');
      $mail->addReplyTo('hr@globalpundits.com', 'HR');
  //     $mail->addCC('cc@example.com');
  //     $mail->addBCC('bcc@example.com');

      //Content
      for ($i=0;$i<count($post_data['to']);$i++) {
        $mail->addAddress($post_data['to'][$i]['text']);
      }
      for ($i=0;$i<count($post_data['cc']);$i++) {
        $mail->addCC($post_data['cc'][$i]['text']);
      }
      for ($i=0;$i<count($post_data['bcc']);$i++) {
        $mail->addBCC($post_data['bcc'][$i]['text']);
      }
    
      for ($i=0;$i<count($post_data['files']);$i++) {
        $mail->addAttachment('./uploads/'.$post_data['files'][$i], $post_data['fileNames'][$i]);
      }  

      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $post_data['subject'];
      $mail->Body    = $post_data['body'];
  //     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();

      $response = [];
      $response['status'] = true;
      $response['message'] = 'Message has been sent';
      $response = json_encode($response, JSON_PRETTY_PRINT);
      echo $response;
  } catch (Exception $e) {
      $response = [];
      $response['status'] = false;
      $response['message'] = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
      $response = json_encode($response, JSON_PRETTY_PRINT);
      echo $response;
  }
}
else {
	echo "Session failed";
}
?>