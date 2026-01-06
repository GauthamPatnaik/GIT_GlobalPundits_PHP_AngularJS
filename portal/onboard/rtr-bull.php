<?php
include(__DIR__."/../common/bullhorn.lib.php");

$session = getBullhornAccess();
$_SESSION['rest_token'] = $session['BhRestToken'];
$_SESSION['rest_url'] = $session['restUrl'];

$curl5 = curl_init();

# Get JSON as a string
$json_str = file_get_contents('php://input');

# Get as an object
$json_obj = json_decode($json_str);

$post_data = json_decode(file_get_contents("php://input"), true);
$can_id = $post_data['id'];




// $feilds = $post_data['feilds'];
// $can_id = "180464";
// $feilds = "name";
$feilds="id,name,firstName,middleName,lastName,email,phone";
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl5, array(
    CURLOPT_RETURNTRANSFER => 1,
 	  CURLOPT_URL => $_SESSION['rest_url']."entity/Candidate/".$can_id."?fields=".$feilds,
// 	  CURLOPT_URL => $_SESSION['rest_url']."entity/Placement/".$can_id."?fields=jobOrder(title,clientCorporation(name,address)),dateBegin,customText8,customText6,customText4,customText5,customText9,customText12,customPayRate1,customPayRate7,payRate,overtimeRate,candidate(name,phone,email)",
//     CURLOPT_URL =>  $_SESSION['rest_url']."search/Placement?query=id:".$can_id."&fields=jobOrder(title),dateBegin,customText8,customText6,customText5,customText9,customPayRate1,customPayRate7,payRate,overtimeRate,candidate(name,phone,email)&count=500&start=0",
));

curl_setopt($curl5, CURLOPT_HTTPHEADER, array('BhRestToken: '.$_SESSION['rest_token'].''));
curl_setopt($curl5, CURLOPT_RETURNTRANSFER, TRUE);
// Send the request & save response to $resp
$resp3 = curl_exec($curl5);
//$resp3 = json_decode($resp3,true);

// Close request to clear up some resources
$err = curl_error($curl5);
curl_close($curl5);


if ($err) {
  echo $err;
} else {
 echo $resp3;
}
?>
