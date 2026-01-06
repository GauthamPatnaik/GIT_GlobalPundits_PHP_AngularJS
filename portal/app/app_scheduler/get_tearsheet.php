<?php
include(__DIR__."/../../common/db.lib.php");
include(__DIR__."/../../common/session.php");
include(__DIR__."/../../common/bullhorn.lib.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$tname = $post_data['tname'];

if (checkSession($id, $session_key)){
  $session = getBullhornAccess();
  $rest_token = $session['BhRestToken'];
  $rest_url = $session['restUrl'];
  
  echo getCandidateFromTearsheet($rest_token, $rest_url, $tname);
}
else {
	echo "Session failed";
}
?>