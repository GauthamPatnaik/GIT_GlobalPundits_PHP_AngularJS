<?php
include("../common/db.lib.php");
include("../common/session.php");
include("../common/docusign.lib.php");
include("../common/referrals.lib.php");

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$type = $post_data['type'];

$mess = array(
  'status' => '',
  'message' => '',
);

if (checkSession($id, $session_key)){

	if ($type=='getRecords') {
    echo getReferralRecords();
    die();
  }
  
  if ($type=='updateBHID') {
    
    $bh_id = $post_data['bhid'];
    $r_mail = $post_data['r_mail'];
    $c_mail = $post_data['c_mail'];
    
    if (updateReferralBHID($r_mail, $c_mail, $bh_id)) {
      if (updateReferralStatus($r_mail, $c_mail, 'updated')) {
        $mess['status'] = true;
        $mess['message'] = 'Updated successfully';

        echo(json_encode($mess));
        die();
      } else {
        $mess['status'] = false;
        $mess['message'] = 'Unable to update status. Please contact web admin';

        echo(json_encode($mess));
        die();
      }
    } else {
      $mess['status'] = false;
      $mess['message'] = 'Unable to update BHID. Please contact web admin';
      
      echo(json_encode($mess));
      die();
    }
    
  }
  if ($type=='updateOnHold') {
    $r_mail = $post_data['r_mail'];
    $c_mail = $post_data['c_mail'];
    
    if (updateReferralStatus($r_mail, $c_mail, 'onhold')) {
      $mess['status'] = true;
      $mess['message'] = 'Updated successfully';
      
      echo(json_encode($mess));
      die();
    } else {
      $mess['status'] = false;
      $mess['message'] = 'Unable to update status. Please contact web admin';
      
      echo(json_encode($mess));
      die();
    }
  }

}
else {
	echo "Session failed";
}
?>