<?php
include("../common/db.lib.php");
include("../common/session.php");
include("../common/textus.lib.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$phone = $post_data['phone'];
$content = $post_data['content'];

if (checkSession($id, $session_key)){
  return sendSMS($phone, $content); 
}
else {
  echo "Session failed";
}
?>