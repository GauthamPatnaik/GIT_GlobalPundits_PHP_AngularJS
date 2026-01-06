<?php
$INTEGRATORKEY = 'c8c64545-2514-4c7d-bc30-e2a86c33bd63';

// Production account
$EMAIL = 'hr@globalpundits.com';
$URL = "https://www.docusign.net/restapi/v2/login_information";

// Test account
// $EMAIL = 'ash@globalpundits.com';
// $URL = "https://demo.docusign.net/restapi/v2/login_information";
// $PASSWORD = 'Globalpundits@18';

$PASSWORD = 'Gpundits5$';
$HEADER = "<DocuSignCredentials><Username>" . $GLOBALS['EMAIL'] . "</Username><Password>" . $GLOBALS['PASSWORD'] . "</Password><IntegratorKey>" . $GLOBALS['INTEGRATORKEY'] . "</IntegratorKey></DocuSignCredentials>";

function docuSignLogin() {

	$curl = curl_init($GLOBALS['URL']);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-DocuSign-Authentication: ".$GLOBALS['HEADER']));

	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status != 200 ) {
		$result = array('status' => '0');
		return $result;
		exit(-1);
	}

	$response = json_decode($json_response, true);
	$accountId = $response["loginAccounts"][0]["accountId"];
	$baseUrl = $response["loginAccounts"][0]["baseUrl"];
	curl_close($curl);

	$result = array('accountID' => $accountId, 'baseUrl' => $baseUrl, 'status' => '1');
	return $result;
}

function creatEnvelope($subject, $body, $docs, $eventNotification, $signHereTabs, $textTabs, $dateSignedTabs, $fullNameTabs, $name, $recipient_email, $carbonCopies) {
  $data = array (
    'status' => 'sent',
    'emailSubject' => $subject,
    'emailBlurb' => $body,
    'documents' => $docs,
    'eventNotification' => $eventNotification,
    'recipients' => 
      array (
        'signers' => 
        array (
          0 => 
          array (
            'tabs' => 
            array (
              'signHereTabs' => $signHereTabs,
              'textTabs' => $textTabs,
              'dateSignedTabs' => $dateSignedTabs,
              'fullNameTabs' => $fullNameTabs,
            ),
            'name' => $name,
            'email' => $recipient_email,
            'recipientId' => count($carbonCopies)+1,
            'routingOrder' => count($carbonCopies)+1,
          ),
        ),
        'carbonCopies' => $carbonCopies,
      ),
  );
  
  return $data;
}

function sendEnvelope($baseUrl, $data) {

	$data = json_encode($data);

	$requestBody = "\r\n"
	."\r\n"
	."--myboundary\r\n"
	."Content-Type: application/json\r\n"
	."Content-Disposition: form-data\r\n"
	."\r\n"
	."$data\r\n"
	."--myboundary--\r\n"
	."\r\n";

	// *** append "/envelopes" to baseUrl and as signature request endpoint
	$curl = curl_init($baseUrl . "/envelopes" );
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	  'Content-Type: multipart/form-data;boundary=myboundary',
	  'Content-Length: ' . strlen($requestBody),
	  "X-DocuSign-Authentication: ".$GLOBALS['HEADER'])
	);

	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if ( $status != 201 ) {
	  	$result = array('status' => '0', 'message' => 'error calling webservice, status is:' . $status, 'jsonResp' => $json_response);
		return $result;
		exit(-1);
	}

	$response = json_decode($json_response, true);
	$envelopeId = $response["envelopeId"];

	//--- display results
	$result = array('envelopeID' => $envelopeId, 'status' => '1', 'message' => 'Document is sent! Envelope ID = ' . $envelopeId, 'jsonResp' => $json_response);
	return $result;
}

function resendEnvelope($baseUrl, $envId, $data) {

	$data = json_encode($data);

	$requestBody = "\r\n"
	."\r\n"
	."--myboundary\r\n"
	."Content-Type: application/json\r\n"
	."Content-Disposition: form-data\r\n"
	."\r\n"
	."$data\r\n"
	."--myboundary--\r\n"
	."\r\n";

	// *** append "/envelopes" to baseUrl and as signature request endpoint
	$curl = curl_init($baseUrl . "/envelopes/".$envId."/recipients?resend_envelope=true" );
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($curl, CURLOPT_POSTFIELDS, $requestBody);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	  'Content-Type: multipart/form-data;boundary=myboundary',
	  'Content-Length: ' . strlen($requestBody),
	  "X-DocuSign-Authentication: ".$GLOBALS['HEADER'])
	);

	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  
	return $json_response;
}

function voidEnvelope($baseUrl, $envId, $data) {

	$data = json_encode($data);

	$requestBody = "\r\n"
	."\r\n"
	."--myboundary\r\n"
	."Content-Type: application/json\r\n"
	."Content-Disposition: form-data\r\n"
	."\r\n"
	."$data\r\n"
	."--myboundary--\r\n"
	."\r\n";

	// *** append "/envelopes" to baseUrl and as signature request endpoint
	$curl = curl_init($baseUrl . "/envelopes/".$envId);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	  'Content-Type: application/json',
	  "X-DocuSign-Authentication: ".$GLOBALS['HEADER'])
	);

	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  
	return $json_response;
}
?>