<?php
include("../common/db.lib.php");
include("../common/session.php");
include("../common/docusign.lib.php");
include("../common/onboarding_status.lib.php");

$post_data = json_decode(file_get_contents("php://input"), true);


$id = $post_data['id'];
$session_key = $post_data['session_key'];

if (checkSession($id, $session_key)){

$baseUrl = docuSignLogin();

$envID = $post_data['envID'];

$data = array (
  'status' => 'voided',
  'voidedReason' => 'Voided from GP Portal by '.$id,
);

$envResp = voidEnvelope($baseUrl['baseUrl'], $envID, $data);
// $envResp = "working";
print_r($envResp);

} else {
  echo"Session error. Please re-login and try again";
}
?>