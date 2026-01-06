<?php
$data = file_get_contents('php://input');
header("Connection: close");
ob_start();
echo("Success");
$size=ob_get_length();
header("Content-Length: $size");
ob_end_flush();
flush();
sleep(3);
echo("do something in the background");

include("common/db.lib.php");
include("common/session.php");
include("common/docusign.lib.php");
include("common/onboarding_status.lib.php");
include("common/bullhorn.lib.php");

$xml = simplexml_load_string ($data, "SimpleXMLElement", LIBXML_PARSEHUGE);
$envelope_id = (string)$xml->EnvelopeStatus->EnvelopeID;
$time_generated = (string)$xml->EnvelopeStatus->TimeGenerated;

$envelope_dir = getcwd() . '/eventNotification';

$session = getBullhornAccess();
$rest_token = $session['BhRestToken'];
$rest_url = $session['restUrl'];
$bhID = getBHIDFromEnvelopeID($envelope_id);
$client = getClientFromEnvelopeID($envelope_id);
$lable='';
if($client=='sc-rtr' || $client=='gp-rtr')
{$lable='RTR Docs ';}
else{$lable='Onboarding Docs ';}

//Captures log
DsignLog($data);
function DsignLog($m){
    $errorInString=$m;
    $errorLogPath = __DIR__.'/Dsigndata.txt';
    date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
    $message="Logged: [".date('d-m-Y H:i:s')."] - Data : ".$errorInString.", \n\n\n";
    file_put_contents($errorLogPath, $message, FILE_APPEND);
}

  
if ((string)$xml->EnvelopeStatus->Status === "Sent") {

    // $envelope_dir = getcwd() . '/eventNotification';
    if(! is_dir($envelope_dir)) {mkdir ($envelope_dir, 0755);}

    $filename = $envelope_dir . "/T" . 
        str_replace (':' , '_' , $time_generated) . "_E_".$envelope_id.".xml"; // substitute _ for : for windows-land
    $ok = file_put_contents ($filename, $data);
        
    if ($ok === false) {
        // Couldn't write the file! Alert the humans!
        error_log ("!!!!!! PROBLEM DocuSign Webhook: Couldn't store $filename !");
        exit (1);
    }
    // log the event
    error_log ("DocuSign Webhook: created $filename");

    $message = 'An email notification with a link to the envelope has been sent to candidate';
    onbaordUpdateEstatus($envelope_id, (string)$xml->EnvelopeStatus->Status, $message);
    $noteID = addNote($rest_token, $rest_url, (int)$bhID, $message, $lable.'- Sent');
    error_log ("Bullhorn Note created - $filename");
}

if ((string)$xml->EnvelopeStatus->Status === "Delivered") {

    $message = 'Candidate has viewed the document(s) in the envelope';
    onbaordUpdateEstatus($envelope_id, (string)$xml->EnvelopeStatus->Status, $message);
    $noteID = addNote($rest_token, $rest_url, (int)$bhID, $message, $lable.'- Delivered');
    error_log ("Bullhorn Note created - $noteID");
}

if ((string)$xml->EnvelopeStatus->Status === "Declined") {

    $message = 'Candidate has declined the envelope';
    onbaordUpdateEstatus($envelope_id, (string)$xml->EnvelopeStatus->Status, $message);
    $noteID = addNote($rest_token, $rest_url, (int)$bhID, $message, $lable.'- Declined');
    error_log ("Bullhorn Note created - $noteID");
}

if ((string)$xml->EnvelopeStatus->Status === "Voided") {

    $message = 'The envelope has been voided';
    onbaordUpdateEstatus($envelope_id, (string)$xml->EnvelopeStatus->Status, $message);
    $noteID = addNote($rest_token, $rest_url, (int)$bhID, $message, $lable.'- Voided');
    error_log ("Bullhorn Note created - $noteID");
}

if ((string)$xml->EnvelopeStatus->Status === "Signed") {

    $message = 'The envelope has been Signed';
    onbaordUpdateEstatus($envelope_id, (string)$xml->EnvelopeStatus->Status, $message);
    $noteID = addNote($rest_token, $rest_url, (int)$bhID, $message, $lable.'- Signed');
    error_log ("Bullhorn Note created - $noteID");
}

if ((string)$xml->EnvelopeStatus->Status === "Completed") {

    $files = array();
    $fileNames = array();
    foreach ($xml->DocumentPDFs->DocumentPDF as $pdf) {
        $fName = explode(".",(string)$pdf->Name);
        array_push($fileNames, $fName[0].".pdf");
        array_push($files, base64_decode ( (string)$pdf->PDFBytes ));
    }

    error_log(create_zip($files, $fileNames, $envelope_dir.'/'.$envelope_id.'.zip'));
    
//     Upload files to bullhorn

    $session = getBullhornAccess();;
    $BhRestToken = $session['BhRestToken'];
    $restUrl = $session['restUrl'];
    
//     Call upload documents function
    
//     $bhID = "137694";
      
    $bhResult = uploadSignedDocuments($BhRestToken, $restUrl, $files, $fileNames, $bhID);
    
    $message = 'The envelope has been completed by the recipient';
    onbaordUpdateEstatus($envelope_id, (string)$xml->EnvelopeStatus->Status, $message);
    $noteID = addNote($BhRestToken, $restUrl, (int)$bhID, $message, $lable.'- Completed');
    error_log ("Bullhorn Note created - $noteID");
    
    if ($bhResult) {
      onbaordUpdateBstatus($envelope_id, $bhResult);
    } else  {
      onbaordUpdateBstatus($envelope_id, 'failed');
    }
}
echo"Success";
?>