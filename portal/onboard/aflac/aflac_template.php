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
$perDiem = $post_data['data']['isPerDiem'];
$recipient_email = $post_data['data']['email'];
$name = $post_data['data']['name'];
$document_name = ['Aflac_Temporary Employment Agreement_Supplier_2022.pdf'];
$docs = array();

// GP Documents array
$gp_docs = addDocs(0, $perDiem);
$docs = array_merge($docs, $gp_docs);

for ($i=0;$i<sizeof($document_name);$i++) {
  $ext = explode(".",$document_name[$i]);	
  $doc = array(
    'documentId' => $i+sizeof($gp_docs)+1,
    'name' => $document_name[$i],
    'fileExtension' => $ext[1],
    'documentBase64' => base64_encode(file_get_contents("template/".$document_name[$i])),
  );
  if($i==1) {
    $doc['display'] = 'modal';
    $doc['signerMustAcknowledge'] = 'view';
    $doc['includeInDownload'] = false;
  }
  array_push($docs, $doc);
}

$signHereTabs = array (
  0 => 
  array (
    'documentId' => '4',
    'pageNumber' => '1',
    'anchorString' => '(Signature)',
    'anchorXOffset' => '5',
    'anchorYOffset' => '-20',
  ) 
);

$textTabs = array (
  0 => 
  array (
    'name' => 'GP',
    'locked' => 'true',
    'tabLabel' => 'Globalpundits',
    'value' => 'Globalpundits',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => 'I am solely an employee of',
    'anchorXOffset' => '150',
    'anchorYOffset' => '-8',
  ),
  1 => 
  array (
    'name' => 'GP2',
    'locked' => 'true',
    'tabLabel' => 'Globalpundits',
    'value' => 'Globalpundits',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => 'As a condition of my assignment by ',
    'anchorXOffset' => '195',
    'anchorYOffset' => '-8',
  ),
  2 => 
  array (
    'name' => 'GP3',
    'locked' => 'true',
    'tabLabel' => 'Globalpundits',
    'value' => 'Globalpundits',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => 'In consideration of my assignment to Aflac by ',
    'anchorXOffset' => '260',
    'anchorYOffset' => '-8',
  ),
  3 => 
  array (
    'name' => 'GP3',
    'locked' => 'true',
    'tabLabel' => 'Globalpundits',
    'value' => 'Globalpundits',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => 'only for such benefits as _',
    'anchorXOffset' => '140',
    'anchorYOffset' => '-9',
  )
);

$dateSignedTabs = array (
  0 => 
  array (
    'name' => 'dated',
    'tabLabel' => 'Date signed',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '2',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => '(Date)',
    'anchorXOffset' => '5',
    'anchorYOffset' => '-30',
  )  
);

$fullNameTabs = array (
  0 => 
  array (
    'name' => 'fullName',
    'tabLabel' => 'Your full name',
    'locked' => 'false',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '2',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => '(Printed Name)',
    'anchorXOffset' => '5',
    'anchorYOffset' => '-30',
  )  
);

// GP Documents Tabs
$gp_tabs = docFields($post_data, $perDiem);

$signHereTabs = array_merge($signHereTabs, $gp_tabs['signHereTabs']);
$textTabs = array_merge($textTabs, $gp_tabs['textTabs']);
$dateSignedTabs = array_merge($dateSignedTabs, $gp_tabs['dateSignedTabs']);
$fullNameTabs = array_merge($fullNameTabs, $gp_tabs['fullNameTabs']);

// Webhook event notification
$eventNotification = eventNotification();

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

$data = creatEnvelope($post_data['subject'], $post_data['body'], $docs, $eventNotification, $signHereTabs, $textTabs, $dateSignedTabs, $fullNameTabs, $name, $recipient_email, $carbonCopies);


$envResp = sendEnvelope($baseUrl['baseUrl'], $data);


echo addOnboardingStatus($envResp['envelopeID'], $post_data['bhID'], $post_data['client'], $name, $recipient_email, $post_data['data']['phone'], 'Init', '', 'Envelope initialized', $id);
  
} else {
  echo"Session error. Please re-login and try again";
}
?>