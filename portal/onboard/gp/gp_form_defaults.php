<?php

// $GP_DOCS = ['GP Offer Letter.docx', 'GP Employee Safety Manual.pdf', 'GP Harassment Policy.pdf', 'Globalpundits Code of Business Conduct and Ethics.pdf', '2021 Globalpundits Benefits Guide.pdf'];
$GP_DOCS = ['GP Offer Letter.docx', 'GP Employee Safety Manual.pdf', 'GP Harassment Policy.pdf', 'Globalpundits Code of Business Conduct and Ethics.pdf','GlobalPundits-2024-Benefits-Placement.pdf' ];


function addDocs($fromDocID, $perDiem=false) {
	$fromDocID += 1;
	$gp_docs = array();
	$gp_d = $GLOBALS['GP_DOCS'];

	for ($i=0;$i<sizeof($gp_d);$i++) {
	  $ext = explode(".",$gp_d[$i]);	
	  $doc = array(
	    'documentId' => $fromDocID+$i,
	    'name' => $gp_d[$i],
	    'fileExtension' => $ext[1],
	    'documentBase64' => base64_encode(file_get_contents("../gp/template/".$gp_d[$i])),
	  );

	  if($i==1 || $i==2 || $i==4) {
	    $doc['display'] = 'modal';
	    $doc['signerMustAcknowledge'] = 'view';
	  }

	  array_push($gp_docs, $doc);
	}
  
  if ($perDiem) {
    $doc = array(
	    'documentId' => $fromDocID+sizeof($gp_d),
	    'name' => 'GP Per Diem v3.docx',
	    'fileExtension' => 'docx',
	    'documentBase64' => base64_encode(file_get_contents("../gp/template/GP Per Diem v3.docx")),
	  );
    
     array_push($gp_docs, $doc);
  }

	return $gp_docs;
}

function docFields($post_data, $perDiem=false) {

	$signHereTabs = array (
	  0 => 
	  array (
	    'anchorString' => 'GPD1P1FT3',
	  ),
    1 => 
	  array (
	    'anchorString' => 'gp_doc_4_sign',
	  ),
	);

	$textTabs = array (
	  0 => 
	  array (
	    'name' => 'Offer Letter Date',
	    'tabLabel' => 'GPOfferLetterDate',
	    'recipientId' => '1',
	    'locked' => 'true',
	    'value' => date("d F, Y", time()),
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1F1',
	  ),
	  1 => 
	  array (
	    'name' => 'Job Title',
	    'tabLabel' => 'GPD1P1F3',
	    'recipientId' => '1',
	    'value' => $post_data['data']['gpOfferJobTitle'],
	    'locked' => 'true',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1F3',
	  ),
	  2 => 
	  array (
	    'name' => 'Start Date',
	    'tabLabel' => 'GPD1P1F4',
	    'recipientId' => '1',
	    'value' => $post_data['data']['gpOfferStartDate'],
	    'locked' => 'true',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1F4',
	  ),
	  3 => 
	  array (
	    'name' => 'Client Assignment',
	    'tabLabel' => 'GPD1P1F5',
	    'recipientId' => '1',
	    'value' => $post_data['data']['gpOfferClientAssignment'],
	    'locked' => 'true',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1F5',
	  ),
	  4=> 
	  array (
	    'name' => 'Work Location',
	    'tabLabel' => 'GPD1P1F6',
	    'recipientId' => '1',
	    'value' => $post_data['data']['gpOfferWorkLocation'],
	    'locked' => 'true',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1F6',
	  ),
	  5 => 
	  array (
	    'name' => 'W-2 Straight/Overtime Pay rate',
	    'tabLabel' => 'GPD1P1F7',
	    'recipientId' => '1',
	    'value' => $post_data['data']['gpOfferOvertime'],
	    'locked' => 'true',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1F7',
	  ),
	  6 => 
	  array (
	    'name' => 'Exemption Status',
	    'tabLabel' => 'GPD1P1F8',
	    'recipientId' => '1',
	    'value' => $post_data['data']['gpOfferExemptionStatus'],
	    'locked' => 'true',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1F8',
	  ),
	  7 => 
	  array (
	    'name' => 'Eligibility for PTO/Vacation',
	    'tabLabel' => 'GPD1P1F9',
	    'recipientId' => '1',
	    'value' => $post_data['data']['gpOfferVacation'],
	    'locked' => 'true',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1F9',
	  ),
	  8 => 
	  array (
	    'name' => 'Eligibility for Holidays',
	    'tabLabel' => 'GPD1P1F10',
	    'recipientId' => '1',
	    'value' => $post_data['data']['gpOfferHolidays'],
	    'locked' => 'true',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1FT0',
	  ),
	  9 => 
	  array (
	    'name' => 'Eligibility Health, Dental, Life, Disability, 401k',
	    'tabLabel' => 'GPD1P1F11',
	    'recipientId' => '1',
	    'value' => $post_data['data']['gpOfferDental'],
	    'locked' => 'true',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1FT1',
	  ),
	);

	$dateSignedTabs = array (
	  0 => 
	  array (
	    'name' => 'DATE SIGNED',
	    'tabLabel' => 'GP Offer letter date',
	    'recipientId' => '1',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'underline' => 'true',
	    'anchorString' => 'GPD1P1FT4',
	  ),
    1 => 
	  array (
	    'name' => 'DATE SIGNED DOC 4',
	    'tabLabel' => 'GP CoC Date',
	    'recipientId' => '1',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'underline' => 'false',
	    'anchorString' => 'gp_doc_4_sdate',
	  ),
	);

	$fullNameTabs = array (
	  0 => 
	  array (
	    'name' => 'Your full name',
	    'locked' => 'false',
	    'tabLabel' => 'cName_gp1',
	    'recipientId' => '1',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'anchorString' => 'GPD1P1F2',
	  ),
	  1 => 
	  array (
	    'name' => 'Your full name',
	    'locked' => 'false',
	    'tabLabel' => 'cName_gp2',
	    'recipientId' => '1',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'underline' => 'true',
	    'anchorString' => 'GPD1P1FT2',
	  ),
    2 => 
	  array (
	    'name' => 'Your full name',
	    'locked' => 'false',
	    'tabLabel' => 'cName_gp3',
	    'recipientId' => '1',
	    'bold' => 'false',
	    'font' => 'TimesNewRoman',
	    'fontSize' => 'Size10',
	    'underline' => 'false',
	    'anchorString' => 'gp_doc_4_name',
	  ),
	);
  
  if ($perDiem) {
    $perDiem_sign =  array (
       0 =>  array (
         'anchorString' => '$perDiem_emp_sign'
       )
    );
    
    $perDiem_sign_date = [
       0 => [
        'name' => 'DATE SIGNED',
        'tabLabel' => 'GP per diem sign date',
        'recipientId' => '1',
        'bold' => 'true',
        'font' => 'TimesNewRoman',
        'fontSize' => 'Size12',
        'underline' => 'true',
        'anchorString' => '$perDiem_sign_date'
       ]
    ];
    
    $perDiem_fullname = [
       0 => [
        'name' => 'Your full name',
        'locked' => 'false',
        'tabLabel' => 'cName_gpPerDiem_1',
        'recipientId' => '1',
        'bold' => 'true',
        'font' => 'TimesNewRoman',
        'fontSize' => 'Size12',
        'anchorString' => '$perDiem_emp_name',
       ]
    ];
    
    $perDiem_text_fields = [
       0 => [
        'name' => 'Principal Place of Business Address',
        'tabLabel' => 'Principal Place of Business Address',
        'recipientId' => '1',
        'value' => $post_data['data']['gpPerDiemPrincipalPlaceOfBusiness'],
        'bold' => 'true',
        'font' => 'TimesNewRoman',
        'fontSize' => 'Size12',
        'anchorString' => '$perDiem_principal_place_of_business',
       ],
      1 => [
        'name' => 'Permanent Residence Address',
        'tabLabel' => 'Permanent Residence Address',
        'recipientId' => '1',
        'value' => $post_data['data']['gpPerDiemPermAddress'],
        'bold' => 'true',
        'font' => 'TimesNewRoman',
        'fontSize' => 'Size12',
        'anchorString' => '$perDiem_perm_address',
      ],
      2 => [
        'name' => 'Temporary Address',
        'tabLabel' => 'Temporary Address',
        'recipientId' => '1',
        'value' => $post_data['data']['gpPerDiemTempAddress'],
        'bold' => 'true',
        'font' => 'TimesNewRoman',
        'fontSize' => 'Size12',
        'anchorString' => '$perDiem_temp_address',
      ],
      3 => [
        'name' => 'GP Contact Person',
        'tabLabel' => 'GP Contact Person',
        'recipientId' => '1',
        'value' => $post_data['data']['gpPerDiemTempContactPerson'],
        'locked' => 'true',
        'bold' => 'true',
        'font' => 'TimesNewRoman',
        'fontSize' => 'Size12',
        'anchorString' => '$perDiem_gp_contact',
      ]
    ];
    
    $signHereTabs = array_merge($signHereTabs, $perDiem_sign);
    $textTabs = array_merge($textTabs, $perDiem_text_fields);
    $dateSignedTabs = array_merge($dateSignedTabs, $perDiem_sign_date);
    $fullNameTabs = array_merge($fullNameTabs, $perDiem_fullname);
  }

	$gp_array = array('signHereTabs' => $signHereTabs, 'textTabs' => $textTabs, 'dateSignedTabs' => $dateSignedTabs, 'fullNameTabs' => $fullNameTabs);
	
	return $gp_array;
}

function eventNotification() {
	$eventNotification = array(
		'envelopeEvents' => array(
      0 => 
      array (
        'envelopeEventStatusCode' => 'Sent'
      ),
      1 => 
      array (
        'envelopeEventStatusCode' => 'Delivered'
      ),
      2 => 
      array (
        'envelopeEventStatusCode' => 'Completed'
      ),
      3 => 
      array (
        'envelopeEventStatusCode' => 'Declined'
      ),
      4 => 
      array (
        'envelopeEventStatusCode' => 'Voided'
      )     
		),
		'includeCertificateOfCompletion' => 'false',
		'includeDocumentFields' => 'false',
		'includeDocuments' => 'true',
		'includeEnvelopeVoidReason' => 'true',
		'includeTimeZone' => 'true',
		'loggingEnabled' => 'true',
		'requireAcknowledgment' => 'true',
		'signMessageWithX509Cert' => 'false',
		'url' => 'https://www.login.globalpundits.com/webhook.php',
		'useSoapInterface' => 'false',
	);

	return $eventNotification;
}
?>