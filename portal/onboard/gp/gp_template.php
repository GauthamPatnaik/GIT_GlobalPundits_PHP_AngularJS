<?php
include("../../common/db.lib.php");
include("../../common/session.php");
include("../../common/docusign.lib.php");
include("../../common/onboarding_status.lib.php");

$post_data = json_decode(file_get_contents("php://input"), true);

include('../gp/gp_form_defaults.php');

$id = $post_data['id'];
$session_key = $post_data['session_key'];

if (checkSession($id, $session_key)){

$baseUrl = docuSignLogin();

$recipient_email = $post_data['data']['email'];
$name = $post_data['data']['name'];
$perDiem = $post_data['data']['isPerDiem'];

// GP Documents array
$gp_docs = addDocs(0, $perDiem);

// GP Documents Tabs
$gp_tabs = docFields($post_data, $perDiem);

$signHereTabs = $gp_tabs['signHereTabs'];
$textTabs = $gp_tabs['textTabs'];
$dateSignedTabs = $gp_tabs['dateSignedTabs'];
$fullNameTabs = $gp_tabs['fullNameTabs'];
  
// Webhook event notification
$eventNotification = eventNotification();

// $data = array (
//   'status' => 'sent',
//   'emailSubject' => $post_data['subject'],
//   'emailBlurb' => $post_data['body'],
//   'documents' => $gp_docs,
//   'eventNotification' => $eventNotification,
//   'recipients' => 
//   array (
//     'signers' => 
//     array (
//       0 => 
//       array (
//         'tabs' => 
//         array (
//           'signHereTabs' => $signHereTabs,
//           'textTabs' => $textTabs,
//           'dateSignedTabs' => $dateSignedTabs,
//           'fullNameTabs' => $fullNameTabs,
//         ),
//         'name' => $name,
//         'email' => $recipient_email,
//         'recipientId' => '1',
//       ),
//     ),
//   ),
// );
  
$carbonCopies = array();
  
for ($i=0;$i<count($post_data['envCC']);$i++) {
  $ext = explode(".",$post_data['envCC'][$i]['text']);	
  $cc = array (
    'name' => $ext[0],
    'email' => $post_data['envCC'][$i]['text'],
    'routingOrder' => $i+1,
    'recipientId' => $i+1,
  );
 array_push($carbonCopies,$cc);
} 

$data = creatEnvelope($post_data['subject'], $post_data['body'], $gp_docs, $eventNotification, $signHereTabs, $textTabs, $dateSignedTabs, $fullNameTabs, $name, $recipient_email, $carbonCopies);

$envResp = sendEnvelope($baseUrl['baseUrl'], $data);

echo addOnboardingStatus($envResp['envelopeID'], $post_data['bhID'], $post_data['client'], $name, $recipient_email, $post_data['data']['phone'], 'Init', '', 'Envelope initialized', $id);
// addOnboardingStatus($envResp['envelopeID'], $post_data['bhID'], $post_data['client'], $name, $recipient_email, $post_data['data']['phone'], 'Init', '', 'Envelope initialized', $id);

// echo $envResp['envelopeID'];
// print_r($post_data);
// $session = getBullhornAccess();
// $rest_token = $session['BhRestToken'];
// $rest_url = $session['restUrl'];
  
// addNote($rest_token, $rest_url, $post_data['bhID'], 'GP Onboaring documemnts sent', 'Onboarding Documents - Sent');
  
} else {
  echo"Session error. Please re-login and try again";
}
?>