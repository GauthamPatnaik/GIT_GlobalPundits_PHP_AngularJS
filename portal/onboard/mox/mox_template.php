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
$document_name = ['Computer Security Code of Conduct.pdf', 'Debarment Statement For Candidates.pdf', 'Non-Disclosure.pdf', 'PAR Form 2018.docx'];

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
  array_push($docs, $doc);
}

$signHereTabs = array (
  0 => 
  array (
    'documentId' => '4',
    'pageNumber' => '5',
    'anchorString' => 'D1P5F3',
  ),
  1 => 
  array (
    'documentId' => '5',
    'pageNumber' => '1',
    'anchorString' => 'D2P1F1',
  ),
  2 => 
  array (
    'documentId' => '6',
    'pageNumber' => '1',
    'anchorString' => 'D3P1F2',
  ),
);

$textTabs = array (
  0 => 
  array (
    'name' => 'Company/Organization/Dept./Division',
    'locked' => 'true',
    'tabLabel' => 'Company/Organization/Dept./Division',
    'value' => 'Globalpundits',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '5',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'D1P5F2',
  ),
  1 => 
  array (
    'name' => 'US Citizen',
    'locked' => 'false',
    'tabLabel' => 'citizen',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '5',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'D1P5F5',
  ),
  2 => 
  array (
    'name' => 'Start Date',
    'locked' => 'false',
    'tabLabel' => 'PAR1',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':START_DATE:',
  ),
  3 => 
  array (
    'name' => 'Full Name (FML – no initials)',
    'locked' => 'false',
    'tabLabel' => 'PAR2',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':FULL_NAME:',
  ),
  4 => 
  array (
    'name' => 'Preferred Name',
    'locked' => 'false',
    'tabLabel' => 'PAR3',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':PREF_NAME:',
  ),
  5 => 
  array (
    'name' => 'Home Address',
    'locked' => 'false',
    'tabLabel' => 'PAR4',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':HOME_ADD:',
  ),
  6 => 
  array (
    'name' => 'Home Phone',
    'locked' => 'false',
    'tabLabel' => 'PAR5',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':HOME_PHN:',
  ),
  7 => 
  array (
    'name' => 'Email Address',
    'locked' => 'false',
    'tabLabel' => 'PAR6',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':EMAIL:',
  ),
  8 => 
  array (
    'name' => 'Social Security Number',
    'locked' => 'false',
    'tabLabel' => 'PAR7',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':SSN:',
  ),
  9 => 
  array (
    'name' => 'Date of Birth (mm/dd/yyyy)',
    'locked' => 'false',
    'tabLabel' => 'PAR8',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':DOB:',
  ),
  10 => 
  array (
    'name' => 'Citizenship',
    'locked' => 'false',
    'tabLabel' => 'PAR9',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':CITIZEN:',
  ),
  11 => 
  array (
    'name' => 'Gender',
    'locked' => 'false',
    'tabLabel' => 'PAR10',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':GENDER:',
  ),
  12 => 
  array (
    'name' => 'Date of SRS GET or CAT',
    'locked' => 'false',
    'tabLabel' => 'PAR11',
    'documentId' => '7',
    'value' => $post_data['data']['moxGETDate'],
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':CAT:',
  ),
  13 => 
  array (
    'name' => 'Emergency Contact Info',
    'locked' => 'false',
    'tabLabel' => 'PAR12',
    'documentId' => '7',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':EMERGENCY_CON:',
  ),
  14 => 
  array (
    'name' => 'Length of Assignment',
    'locked' => 'false',
    'tabLabel' => 'PAR13',
    'documentId' => '7',
    'value' => $post_data['data']['moxLoA'],
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':LoA:',
  ),
  15 => 
  array (
    'name' => 'MOX Requisition Number',
    'locked' => 'false',
    'tabLabel' => 'PAR14',
    'documentId' => '7',
    'value' => $post_data['data']['moxReqNum'],
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':MOX_REQ_NUM:',
  ),
  16 => 
  array (
    'name' => 'Employing Company/Agency',
    'locked' => 'false',
    'tabLabel' => 'PAR15',
    'documentId' => '7',
    'value' => 'Globalpundits',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':EMP_AGENCY:',
  ),
  17 => 
  array (
    'name' => 'Company/Agency Billing Code',
    'locked' => 'false',
    'tabLabel' => 'PAR16',
    'documentId' => '7',
    'value' => '10888-B-00006519',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':BILL_CODE:',
  ),
  18 => 
  array (
    'name' => 'MOX Reporting Supervisor',
    'locked' => 'false',
    'tabLabel' => 'PAR17',
    'documentId' => '7',
    'recipientId' => '1',
    'locked' => 'true',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':MOX_REP_SUP:',
  ),
  19 => 
  array (
    'name' => 'Company/Agency Reporting Supervisor',
    'locked' => 'false',
    'tabLabel' => 'PAR18',
    'documentId' => '7',
    'value' => 'Joe Doyle',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'Arial',
    'fontSize' => 'Size10',
    'anchorString' => ':AGENCY_REP_SUP:',
  ),
);

$dateSignedTabs = array (
  0 => 
  array (
    'name' => 'DATE',
    'tabLabel' => 'footer date',
    'documentId' => '4',
    'recipientId' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size10',
    'anchorString' => 'D1DATE',
  ),
  1 => 
  array (
    'name' => 'DATE',
    'tabLabel' => 'Date signed',
    'documentId' => '4',
    'recipientId' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'D1P5F4',
  ),
  2 => 
  array (
    'name' => 'DATE',
    'tabLabel' => 'Date signed1',
    'documentId' => '5',
    'recipientId' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'D2P1F2',
  ),
  3 => 
  array (
    'name' => 'DATE',
    'tabLabel' => 'Date signed2',
    'documentId' => '6',
    'recipientId' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'D3P1F3',
  ),
);

$fullNameTabs = array (
  0 => 
  array (
    'name' => 'Your full name',
    'locked' => 'false',
    'tabLabel' => 'cName',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '5',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'D1P5F1',
  ),
  1 => 
  array (
    'name' => 'Your full name',
    'locked' => 'false',
    'tabLabel' => 'cName1',
    'documentId' => '5',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'D2P1F3',
  ),
  2 => 
  array (
    'name' => 'Your full name',
    'locked' => 'false',
    'tabLabel' => 'cName2',
    'documentId' => '6',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'D3P1F1',
  ),
);

$initialHereTabs = array (
  0 => 
  array (
    'documentId' => '4',
    'anchorString' => 'D1INIT',
  ),
);

// GP Documents Tabs
$gp_tabs = docFields($post_data, $perDiem);

$signHereTabs = array_merge($signHereTabs, $gp_tabs['signHereTabs']);
$textTabs = array_merge($textTabs, $gp_tabs['textTabs']);
$dateSignedTabs = array_merge($dateSignedTabs, $gp_tabs['dateSignedTabs']);
$fullNameTabs = array_merge($fullNameTabs, $gp_tabs['fullNameTabs']);
  
// Webhook event notification
$eventNotification = eventNotification();

// $data = array (
//   'status' => 'sent',
//   'emailSubject' => $post_data['subject'],
//   'emailBlurb' => $post_data['body'],
//   'documents' => $docs,
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
//           'initialHereTabs' => $initialHereTabs,
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

$data = creatEnvelope($post_data['subject'], $post_data['body'], $docs, $eventNotification, $signHereTabs, $textTabs, $dateSignedTabs, $fullNameTabs, $name, $recipient_email, $carbonCopies);
  
$envResp = sendEnvelope($baseUrl['baseUrl'], $data);

echo addOnboardingStatus($envResp['envelopeID'], $post_data['bhID'], $post_data['client'], $name, $recipient_email, $post_data['data']['phone'], 'Init', '', 'Envelope initialized', $id);
// print_r($post_data);
  
// $session = getBullhornAccess();
// $rest_token = $session['BhRestToken'];
// $rest_url = $session['restUrl'];
  
// addNote($rest_token, $rest_url, $post_data['bhID'], 'MOX Onboaring documemnts sent', 'Onboarding Documents - Sent');
  
} else {
  echo"Session error. Please re-login and try again";
}
?>