<?php
include("db.lib.php");
include("API.php");

$post_data = json_decode(file_get_contents("php://input"), true);

$res = array(
    'message' => '',
    'status' => ''
);

$authCode = getAuthCode();
$auth = doBullhornAuth($authCode);
$tokens = json_decode($auth);
$session = doBullhornLogin($tokens->access_token);
$session = json_decode($session,true);

$rest_token = $session['BhRestToken'];
$rest_url = $session['restUrl'];
$bh_id = $post_data['bh_id'];

$res = array(
    'message' => '',
    'status' => ''
);

$checkDB = checkTrackID($bh_id);

if ($checkDB['status']) {
    $score = checkStatus($rest_token, $rest_url, $bh_id);

    if ($stat =="zero") {
        $status = "s1";
    }
    elseif ($stat=="Submitted" || $stat=="Contact Message" || $stat=="Submitted Client") {
        $status = "s2";
    }
    elseif ($stat=="Interview Scheduled") {
        $status = "s3";
    }
    elseif ($stat=="Placed") {
        $status = "s4";
    }
    else {
        $status = "s1";
    }

    $res['status'] = true;
    $res['message'] = $status;

    echo(json_encode($res));
} else {
    echo(json_encode($checkDB));
}





?>