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
$recipient_phone=$post_data['data']['phone'];
$name = $post_data['data']['name'];
$position= $post_data['data']['position'];
$requisition = $post_data['data']['requisition'];
$document_name = ['SC RTR.docx'];

$docs = array();

// GP Docs
//$gp_docs = addDocs(0, $perDiem);
//$docs = array_merge($docs, $gp_docs);

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
  }
  array_push($docs, $doc);
}


$answerFields = array();
for ($j=0;$j<17;$j++) {
  $ans = array (
              'tabId' => 'Ans'.($j+1),
              'tabLabel' => 'Ans'.($j+1),
              'sharef' => 'fasle',
              'name' => 'Enter the answer or enter True/False wherever applicable',
              'documentId' => '5',
              'recipientId' => '1',
              'pageNumber' => '1',
              'bold' => 'false',
              'font' => 'TimesNewRoman',
              'fontSize' => 'Size10',
              'anchorString' => '(Ans'.($j+1).')',
              'anchorXOffset' => '40',
              'anchorYOffset' => '-5',
            );
  array_push($answerFields, $ans);
}
$textTab1 = array (
   'name' => 'Email',
   'locked' => 'true',
   'tabLabel' => 'Email',
   'value' => $recipient_email,
   'documentId' => '6',
   'recipientId' => '1',
   'pageNumber' => '1',
   'bold' => 'false',
   'font' => 'TimesNewRoman',
   'fontSize' => 'Size12',
   'anchorString' => 'Consultant Email (not the supplier’s email): ',
   'anchorXOffset' => '320',
   'anchorYOffset' => '-8',
 );
 $textTab2 = array (
  'name' => 'Email',
  'locked' => 'true',
  'tabLabel' => 'Email',
  'value' => $recipient_phone,
  'documentId' => '6',
  'recipientId' => '1',
  'pageNumber' => '1',
  'bold' => 'false',
  'font' => 'TimesNewRoman',
  'fontSize' => 'Size12',
  'anchorString' => 'Consultant Phone (not the supplier’s phone): ',
  'anchorXOffset' => '320',
  'anchorYOffset' => '-4',
);          
 $textTab3 = array (
  'name' => 'RequisitionNumber',
  'locked' => 'true',
  'tabLabel' => 'RequisitionNumber',
  'value' => $requisition,
  'documentId' => '6',
  'recipientId' => '1',
  'pageNumber' => '1',
  'bold' => 'false',
  'font' => 'TimesNewRoman',
  'fontSize' => 'Size10',
  'anchorString' => 'Number _',
  'anchorXOffset' => '60',
  'anchorYOffset' => '-5',
); 
 $textTab4 = array (
  'name' => 'Position',
  'locked' => 'true',
  'tabLabel' => 'Position',
  'value' => $position,
  'documentId' => '6',
  'recipientId' => '1',
  'pageNumber' => '1',
  'bold' => 'false',
  'font' => 'TimesNewRoman',
  'fontSize' => 'Size10',
  'anchorString' => 'position_',
  'anchorXOffset' => '60',
  'anchorYOffset' => '-5',
); 

array_push($answerFields, $textTab1);
array_push($answerFields, $textTab2);
array_push($answerFields, $textTab3);
array_push($answerFields, $textTab4);

$signTabs = array (
  0 =>  
  array (
    'documentId' => '5',
    'pageNumber' => '1',
    'anchorString' => 'Signature3 ',
    'anchorXOffset' => '60',
    'anchorYOffset' => '0',
  ),
);

$dateSignedTabs = array (
  0 =>   
  array (
    'name' => 'dateSigned',
    'tabLabel' => 'Date signed',
    'documentId' => '6',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => 'Date:',
    'anchorXOffset' => '40',
    'anchorYOffset' => '-8',
  ),
 
);

$fullNameTabs = array (
  0 =>   
  array (
    'name' => 'fullName2',
    'tabLabel' => 'Your full name',
    'locked' => 'false',
    'documentId' => '6',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'Name:',
    'anchorXOffset' => '50',
    'anchorYOffset' => '-4',
  ),
  1 => 
  array (
    'name' => 'fullName2',
    'tabLabel' => 'Your full name',
    'locked' => 'false',
    'documentId' => '6',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'Consultant Name :',
    'anchorXOffset' => '140',
    'anchorYOffset' => '-4',
  ),
  2 => 
  array (
    'name' => 'fullName2',
    'tabLabel' => 'Your full name',
    'locked' => 'false',
    'documentId' => '6',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => ' I,_____',
    'anchorXOffset' => '10',
    'anchorYOffset' => '10',
  ),
);


$gp_tabs = docFields($post_data, $perDiem);
$signTabs = array_merge($signTabs, $gp_tabs['signHereTabs']);
$answerFields = array_merge($answerFields, $gp_tabs['textTabs']);
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

$data = creatEnvelope($post_data['subject'], $post_data['body'], $docs, $eventNotification, $signTabs, $answerFields, $dateSignedTabs, $fullNameTabs, $name, $recipient_email, $carbonCopies);

$envResp = sendEnvelope($baseUrl['baseUrl'], $data);

print_r($baseUrl);
print_r($envResp);
echo addOnboardingStatus($envResp['envelopeID'], $post_data['bhID'], $post_data['client'], $name, $recipient_email, $post_data['data']['phone'], 'Init', '', 'Envelope initialized', $id);
// print_r($post_data);
// $session = getBullhornAccess();
// $rest_token = $session['BhRestToken'];
// $rest_url = $session['restUrl'];
  
// addNote($rest_token, $rest_url, $post_data['bhID'], 'BCBS Onboaring documemnts sent', 'Onboarding Documents - Sent');

} else {
  echo"Session error. Please re-login and try again";
}
?>