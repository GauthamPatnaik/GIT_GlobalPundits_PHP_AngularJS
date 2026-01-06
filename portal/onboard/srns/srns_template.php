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
$document_name = ['Confidentiality agreement.docx', 'SRNS End-User Info.docx', 'SRNS Workforce Substance Abuse Program Acknowledgement.docx', 'PF-245.docx','Globalpundits PER DIEM ELIGIBILITY CERTIFICATION.docx', 'srs_visitor_guide.pdf','2021 Year at a Glance Calendar.pdf','SRNS Verification of COVID-19 Vaccination.pdf','SRNS DOE Guidance Vaccine Mandate Letter.pdf'];

$docs = array();

// GP Documents array
$gp_docs = addDocs(0,$perDiem);
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
    'pageNumber' => '2',
    'anchorString' => '(Signature1)',
    'anchorXOffset' => '-10',
    'anchorYOffset' => '-20',
  ),
  1 => 
  array (
    'documentId' => '6',
    'pageNumber' => '1',
    'anchorString' => '( Signature3)',
    'anchorXOffset' => '5',
    'anchorYOffset' => '-20',
  ),
  2 => 
  array (
    'documentId' => '8',
    'pageNumber' => '1',
    'anchorString' => '(pf_signature)',
  ),
3 => 
  array (
    'documentId' => '10',
    'pageNumber' => '2',
    'anchorString' => '(Employee Signature)',
  ) 
 

);

$textTabs = array (
  0 => 
  array (
    'name' => 'subConNum',
    'locked' => 'true',
    'tabLabel' => 'Sub contract number',
    'value' => '',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size11',
    'anchorString' => 'subcontract number ',
    'anchorXOffset' => '130',
    'anchorYOffset' => '-7',
  ),
  1 => 
  array (
    'name' => 'fullName2',
    'locked' => 'false',
    'tabLabel' => 'Full Legal Name',
    'value' => $post_data['data']['name'],
    'documentId' => '5',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'Full Legal Name ',
    'anchorXOffset' => '350',
    'anchorYOffset' => '-6',
  ),
  2 => 
  array (
    'name' => 'phone',
    'locked' => 'false',
    'tabLabel' => 'phone number',
    'value' => $post_data['data']['phone'],
    'documentId' => '5',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'Home Phone Number ',
    'anchorXOffset' => '350',
    'anchorYOffset' => '-9',
  ),
  3 => 
  array (
    'name' => 'Date of Birth (mm/dd/yyyy)',
    'locked' => 'false',
    'tabLabel' => 'dob',
    'value' => '',
    'documentId' => '5',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'Date of Birth ',
    'anchorXOffset' => '350',
    'anchorYOffset' => '-9',
  ),
  4 => 
  array (
    'name' => 'US',
    'locked' => 'false',
    'tabLabel' => 'US Citizenship?',
    'value' => '',
    'documentId' => '5',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'US Citizen (yes or no)',
    'anchorXOffset' => '350',
    'anchorYOffset' => '-9',
  ),
  5 => 
  array (
    'name' => 'Gender',
    'locked' => 'false',
    'tabLabel' => 'Gender',
    'value' => '',
    'documentId' => '5',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => '(Gender)',
    'anchorXOffset' => '350',
    'anchorYOffset' => '-9',
  ),
  6 => 
  array (
    'name' => 'Full Address',
    'locked' => 'false',
    'tabLabel' => 'address',
    'value' => '',
    'documentId' => '5',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'Permanent Home Address',
    'anchorXOffset' => '350',
    'anchorYOffset' => '-9',
    'width' => '220',
    'height' => '90',
  ),
  7 => 
  array (
    'name' => 'Position Title',
    'locked' => 'true',
    'tabLabel' => 'Position Title',
    'value' => $post_data['data']['gpOfferJobTitle'],
    'documentId' => '8',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => '(pos_title)',
    'anchorXOffset' => '-5',
    'anchorYOffset' => '-5'
  ),
  8 => 
  array (
    'name' => 'Start Date',
    'locked' => 'true',
    'tabLabel' => 'Start Date',
    'value' => $post_data['data']['gpOfferStartDate'],
    'documentId' => '8',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => '(start_date)',
    'anchorXOffset' => '-5',
    'anchorYOffset' => '-5'
  )


);

$dateSignedTabs = array (
  0 => 
  array (
    'name' => 'dateSigned1',
    'tabLabel' => 'Date signed',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size11',
    'anchorString' => 'Date1:',
    'anchorXOffset' => '80',
    'anchorYOffset' => '-2',
  ),
  1 => 
  array (
    'name' => 'dateSigned3',
    'tabLabel' => 'Date signed',
    'documentId' => '6',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size11',
    'anchorString' => 'Date3:',
    'anchorXOffset' => '60',
    'anchorYOffset' => '-2',
  ),
  2 => 
  array (
    'name' => 'dateSigned4',
    'tabLabel' => 'Date signed',
    'documentId' => '8',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => 'pf_date'
  ),
 3 => 
  array (
    'name' => 'dateSigned4',
    'tabLabel' => 'Date signed',
    'documentId' => '10',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => '(Date)'
  ),

);

$fullNameTabs = array (
  0 => 
  array (
    'name' => 'name1',
    'locked' => 'false',
    'tabLabel' => 'Your full name',
    'value' => $post_data['data']['name'],
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size11',
    'anchorString' => '(Name)',
    'anchorXOffset' => '50',
    'anchorYOffset' => '-6',
  ),
  1 => 
  array (
    'name' => 'fullName',
    'tabLabel' => $post_data['data']['name'],
    'locked' => 'false',
    'documentId' => '4',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size11',
    'anchorString' => 'Name1',
    'anchorXOffset' => '80',
    'anchorYOffset' => '-2',
  ),
  2 => 
  array (
    'name' => 'name3',
    'tabLabel' => $post_data['data']['name'],
    'locked' => 'false',
    'documentId' => '6',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size11',
    'anchorString' => '(Printed Name3)',
    'anchorXOffset' => '5',
    'anchorYOffset' => '-25',
  ),
  3 => 
  array (
    'name' => 'name4',
    'tabLabel' => $post_data['data']['name'],
    'locked' => 'true',
    'documentId' => '8',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => '(emp_name)',
    'anchorXOffset' => '-5',
    'anchorYOffset' => '-5'
  ),
3 => 
  array (
    'name' => 'name5',
    'tabLabel' => $post_data['data']['name'],
    'locked' => 'true',
    'documentId' => '10',
    'recipientId' => '1',
    'pageNumber' => '1',
    'bold' => 'false',
    'font' => 'TimesNewRoman',
    'fontSize' => 'Size12',
    'anchorString' => '( Employee Name)',
    'anchorXOffset' => '-5',
    'anchorYOffset' => '-5'
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
print_r($envResp);

// $session = getBullhornAccess();
// $rest_token = $session['BhRestToken'];
// $rest_url = $session['restUrl'];
  
// addNote($rest_token, $rest_url, $post_data['bhID'], 'SRNS Onboaring documemnts sent', 'Onboarding Documents - Sent');
  
} else {
  echo"Session error. Please re-login and try again";
}
?>