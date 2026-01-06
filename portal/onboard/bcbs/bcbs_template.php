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
// $document_name = ['Our Values Disclaimer Form.pdf', 'Our Values 2018.pdf', '2018 Our Values answer sheet.docx', 'Our Values Attestation Form.pdf','Our-Values-2022- Handbook.pdf','2022-Our-Values-Attestation-Disclaimer.pdf'];
//$document_name = ['BCBS Confidentiality-Agreement.pdf', 'Our-Values.pdf', 'Our-Values-Training-Guide.pdf','Security-Rules-of-Behavior-General-Users.pdf','Security-Rules-of-Behavior-Privileged-Users.pdf'];
$document_name = ['BCBS Confidentiality-Agreement.pdf', 'Our-Values2022.pdf','2018 Our Values answer sheet.docx', 'Our-Values-Training-Guide.pdf','Security-Rules-of-Behavior-General-Users.pdf','Security-Rules-of-Behavior-Privileged-Users.pdf'];


$docs = array();

// GP Docs
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
              'name' => 'bcbsID',
              'tabId' => 'BCBS Emp ID',
              'value' => $post_data['data']['bcbsID'],
              'documentId' => '4',
              'recipientId' => '1',
              'pageNumber' => '1',
              'bold' => 'false',
              'font' => 'Calibri',
              'fontSize' => 'Size12',
              'anchorString' => 'EMPLOYEE’S/CONTRACTOR’S ID',
              'anchorXOffset' => '5',
              'anchorYOffset' => '-30',
            );
$textTab2 = array (
              'name' => 'bcbsID',
              'tabId' => 'BCBS Emp ID',
              'value' => $post_data['data']['bcbsID'],
              'documentId' => '5',
              'recipientId' => '1',
              'pageNumber' => '1',
              'bold' => 'false',
              'font' => 'TimesNewRoman',
              'fontSize' => 'Size10',
              'anchorString' => 'BlueCross ID3',
              'anchorXOffset' => '80',
              'anchorYOffset' => '-5',
            );  
$textTab3 = array (
              'name' => 'bcbsID',
              'tabId' => 'BCBS Emp ID',
              'value' => $post_data['data']['bcbsID'],
              'documentId' => '6',
              'recipientId' => '1',
              'pageNumber' => '1',
              'bold' => 'false',
              'font' => 'TimesNewRoman',
              'fontSize' => 'Size12',
              'anchorString' => 'BlueCross ID:',
              'anchorXOffset' => '120',
              'anchorYOffset' => '-10',
            );    
$textTab4 = array (
              'name' => 'dueDate',
              'tabLabel' => 'Due Date',
              'documentId' => '5',
              'recipientId' => '1',
              'pageNumber' => '1',
              'value' => $post_data['data']['gpOfferStartDate'],
              'locked' => 'true',
              'bold' => 'false',
              'font' => 'TimesNewRoman',
              'fontSize' => 'Size10',
              'anchorString' => '(due date)',
              'anchorXOffset' => '50',
              'anchorYOffset' => '-3',
            );
 $textTab5 = array (
              'name' => 'Instructor',
              'tabLabel' => 'Instructor',
              'documentId' => '6',
              'recipientId' => '1',
              'pageNumber' => '1',
              'value' => 'Self',
              'locked' => 'true',
              'bold' => 'false',
              'font' => 'Calibri',
              'fontSize' => 'Size12',
              'anchorString' => 'OV_A_1',
              'anchorXOffset' => '0',
              'anchorYOffset' => '6',
            );
 $textTab6 = array (
              'name' => 'Location',
              'tabLabel' => 'Location',
              'documentId' => '6',
              'recipientId' => '1',
              'pageNumber' => '1',
              'value' => 'Online',
              'locked' => 'true',
              'bold' => 'false',
              'font' => 'Calibri',
              'fontSize' => 'Size12',
              'anchorString' => 'OV_A_2',
              'anchorXOffset' => '0',
              'anchorYOffset' => '6',
            );
 $textTab7 = array (
            'name' => 'Time of signing this document (HH:MM:SS in 24hrs format)',
            'tabLabel' => 'Time:',
            'documentId' => '6',
            'recipientId' => '1',
            'pageNumber' => '1',
            'value' => '',
            'locked' => 'false',
            'bold' => 'false',
            'font' => 'Calibri',
            'fontSize' => 'Size12',
            'anchorString' => 'OV_A_4',
            'anchorXOffset' => '0',
            'anchorYOffset' => '6',
          );

array_push($answerFields, $textTab1);
array_push($answerFields, $textTab2);
array_push($answerFields, $textTab3);
array_push($answerFields, $textTab4);
array_push($answerFields, $textTab5);
array_push($answerFields, $textTab6);
array_push($answerFields, $textTab7);

$signTabs = array (
  0 => 
  array (
    'documentId' => '4',
    'pageNumber' => '1',
    'anchorString' => 'EMPLOYEE’S/CONTRACTOR’S SIGNATURE',
    'anchorXOffset' => '5',
    'anchorYOffset' => '-25',
  ),
  1 => 
  array (
    'documentId' => '5',
    'pageNumber' => '1',
    'anchorString' => 'Signature3 ',
    'anchorXOffset' => '60',
    'anchorYOffset' => '0',
  ),
  2 => 
  array (
    'documentId' => '6',
    'pageNumber' => '1',
    'anchorString' => 'Signature:',
    'anchorXOffset' => '25',
    'anchorYOffset' => '-25',
  ),
);

$dateSignedTabs = array (
  0 => 
  array (
    'name' => 'dateSigned',
    'tabLabel' => 'Date signed',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => '-DATE-',
    'anchorXOffset' => '5',
    'anchorYOffset' => '-25',
  ),
  1 => 
  array (
    'name' => 'dateSigned2',
    'tabLabel' => 'Date signed',
    'documentId' => '5',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size10',
    'anchorString' => 'Date3 ',
    'anchorXOffset' => '35',
    'anchorYOffset' => '-4',
  ),
  2 => 
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
    'anchorXOffset' => '5',
    'anchorYOffset' => '-28',
  ),
  3 => 
  array (
    'name' => 'dateSigned7',
    'tabLabel' => 'Date signed',
    'documentId' => '6',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => 'OV_A_3',
    'anchorXOffset' => '0',
    'anchorYOffset' => '0',
  ),
);

$fullNameTabs = array (
  0 => 
  array (
    'name' => 'fullName1',
    'tabLabel' => 'Your full name',
    'locked' => 'false',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Calibri',
    'fontSize' => 'Size12',
    'anchorString' => 'PRINTED NAME OF EMPLOYEE/CONTRACTOR',
    'anchorXOffset' => '5',
    'anchorYOffset' => '-25',
  ),
  1 => 
  array (
    'name' => 'fullName2',
    'tabLabel' => 'Your full name',
    'locked' => 'false',
    'documentId' => '5',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size10',
    'anchorString' => 'Name3 ',
    'anchorXOffset' => '35',
    'anchorYOffset' => '-3',
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
    'anchorString' => 'Name:',
    'anchorXOffset' => '60',
    'anchorYOffset' => '-8',
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