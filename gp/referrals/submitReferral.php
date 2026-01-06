<?php
include("db.lib.php");
include("API.php");
include(__DIR__."/../../portal/common/mail.lib.php");
require(__DIR__.'/../../portal/vendor/autoload.php');

$post_data = json_decode(file_get_contents("php://input"), true);

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
}

function isValidPhone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if(strlen($phone) >= 10) {
        return true;
    }
    return false;
}


// echo("<pre>");
// print_r(insertReferral("Ash", "ash@globalpundits.com", "1231231231", "Atif", "atif@globalpundits.com", "9090909090", "", ""));

// echo(json_encode(isValidPhone($post_data['fields']['r_phn'])));
// echo("</pre>");
$res = array(
    'message' => '',
    'status' => ''
);

if (in_array("", $post_data['fields'])) {
    $res['status'] = false;
    $res['message'] = "Field(s) are empty";

    echo json_encode($res);
    die();
}

$c_name = preg_replace('/\s+/', '', $post_data['fields']['c_name']);
$r_name = preg_replace('/\s+/', '', $post_data['fields']['r_name']);

if ($cname==="" || $r_name==="") {
    $res['status'] = false;
    $res['message'] = "Invalid name(s)";

    echo json_encode($res);
    die();
}

if (!isValidEmail($post_data['fields']['c_mail'])) {
    $res['status'] = false;
    $res['message'] = "Invalid referee email";

    echo json_encode($res);
    die();
}

if (!isValidEmail($post_data['fields']['r_mail'])) {
    $res['status'] = false;
    $res['message'] = "Invalid candidate email";

    echo json_encode($res);
    die();
}

if (!isValidPhone($post_data['fields']['c_phn'])) {
    $res['status'] = false;
    $res['message'] = "Invalid referee phone";

    echo json_encode($res);
    die();
}

if (!isValidPhone($post_data['fields']['r_phn'])) {
    $res['status'] = false;
    $res['message'] = "Invalid candidate phone";

    echo json_encode($res);
    die();
}

$authCode = getAuthCode();
$auth = doBullhornAuth($authCode);
$tokens = json_decode($auth);
$session = doBullhornLogin($tokens->access_token);
$session = json_decode($session,true);

$rest_token = $session['BhRestToken'];
$rest_url = $session['restUrl'];

$score = checkCandidate($rest_token, $rest_url, $post_data['fields']['c_mail']);

if ($score==1) {
    $res['status'] = false;
    $res['message'] = "We already have the candidate profile with us";

    echo json_encode($res);
    die();
} else {
  echo(json_encode(insertReferral($post_data['fields'])));
  
//   Mail to Globalpundits
  $subject = "New referral";

  $message = "Name: ".$post_data['fields']['c_name']."<br>";
  $message .= "Email: ".$post_data['fields']['c_mail']."<br>";
  $message .= "Phone: ".$post_data['fields']['c_phn']."<br>";

$mailTo = "gp@globalpundits.com";
//$mailTo = "mailtophani2@gmail.com";
  $mailer = new sendMail();
  $mailer->setTo($mailTo);
  $mailer->setContent($subject, $message);
  $mailRes = $mailer->send();
  
//   Mail to referee
//   $subject = "Thank you for referring t";
  
//   $message = "Name: ".$post_data['fields']['c_name']."<br>";
//   $message .= "Email: ".$post_data['fields']['c_mail']."<br>";
//   $message .= "Phone: ".$post_data['fields']['c_phn']."<br>";

//   $mailTo = "gp@globalpundits.com";
//   $mailer = new sendMail();
//   $mailer->setTo($mailTo);
//   $mailer->setContent($subject, $message);
//   $mailRes = $mailer->send();
}

?>