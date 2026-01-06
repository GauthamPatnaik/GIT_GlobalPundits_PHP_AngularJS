<?php
include("../../common/db.lib.php");
include("../../common/bullhorn.lib.php");
include("../../common/mail.lib.php");
require(__DIR__.'/../../vendor/autoload.php');

use Medoo\Medoo;

$db = medoo('lobalpun_careers');
$data = $db->query("SELECT * FROM job_submissions WHERE status = 'new' OR status = 'failed'")->fetchAll();

function updateStatus($lastName, $email, $status) {
  $db = medoo('lobalpun_careers');
  $db->query("UPDATE job_submissions SET status = '".$status."' WHERE lastName = '".$lastName."' AND email = '".$email."'");
}

function updateBHID($lastName, $email, $bhID) {
  $db = medoo('lobalpun_careers');
  $db->query("UPDATE job_submissions SET bhid = '".$bhID."' WHERE lastName = '".$lastName."' AND email = '".$email."'");
//   $db->query("SELECT * fom job_submissions");
}

// $data = [
//     'firstName' => 'Mohammed',
//     'lastName' => 'Ashfaq',
//     'mail' => 'ash@globalpundits.com',
//     'phone' => '9999999999'
//   ];


$log = "--------------".date('Y-m-d\TH:i:s.Z\Z', time())."--------------".PHP_EOL;
$log .= "Total application(s) in this run: ".count($data).PHP_EOL;

for ($i=0;$i<count($data);$i++) {
  $session = getBullhornAccess();
  $rest_token = $session['BhRestToken'];
  $rest_url = $session['restUrl'];
  
  if ($bhID = checkCandidate($rest_token, $rest_url, $data[$i]['firstName'], $data[$i]['lastName'], $data[$i]['email'])) {
    $log .= "Cadidate found with bhID: ".$bhID.PHP_EOL;
    updateBHID($data[$i]['lastName'], $data[$i]['email'], $bhID);
    echo $bhID;
    
  } else {
    if ($desc = parseResume($rest_token, $rest_url, $data[$i]['resumeData'], $data[$i]['resumeExtension'], $data[$i]['resumeFileType'])) {
      $log .= "Resume parsed successfully".PHP_EOL; 
    } else {
      $log .= "[ERROR] Resume parsing failed".PHP_EOL;
      $desc = "Resume parsing failed...";
    }
    
    if ($bhID = addCandidate($rest_token, $rest_url, $data[$i], $desc)) {
      $log .= "New candidate created with bhID: ".$bhID.PHP_EOL;
      updateBHID($data[$i]['lastName'], $data[$i]['email'], $bhID);
    } else {
      $log .= "[ERROR] Couldn't create new candidate".PHP_EOL;
      updateStatus($data[$i]['lastName'], $data[$i]['email'], 'failed'); 
      continue;
    }
  }
  
  if ($fileID = uploadCandidateResume($rest_token, $rest_url, $data[$i]['resumeData'], $data[$i]['resumeExtension'], $bhID)) {
    
    if ($fileID['fileId']) {
      $log .= "Uploaded resume to ".$bhID." with file ID: ".$fileID.PHP_EOL;  
    } else {
      $log .= "Error while uploading resume in Bullhorn".PHP_EOL;
      $log .= var_export($fileID, TRUE).PHP_EOL;
      $log .= "-----------".PHP_EOL;
    }
     
  } else {
    $log .= "[ERROR] Couldn't upload resume".PHP_EOL;
    $log .= uploadCandidateResume($rest_token, $rest_url, $data[$i]['resumeData'], $data[$i]['resumeExtension'], $bhID);
    updateStatus($data[$i]['lastName'], $data[$i]['email'], 'failed');
    continue;
  }
  
  if ($submissionID = submitJob($rest_token, $rest_url, $bhID, $data[$i]['jobID'])) {
    $log .= "Submitted ".$data[$i]['lastName'].", ".$data[$i]['firstName']." with submission ID: ".$submissionID.PHP_EOL;
    updateStatus($data[$i]['lastName'], $data[$i]['email'], $submissionID);
  } else {
    $log .= "[ERROR] Couldn't submit candidate".PHP_EOL;
    updateStatus($data[$i]['lastName'], $data[$i]['email'], 'failed');
    continue;
  }
  
  $log .= "____________________".PHP_EOL;
}


$mailTo = "ash@globalpundits.com";

$mailBody = str_replace(PHP_EOL, ("<br />".PHP_EOL), $log);
if (count($data)>0) {
  $mailer = new sendMail();
  $mailer->setTo($mailTo);
  $mailer->setContent("Career script output", $mailBody);
  $mailRes = $mailer->send();

  $log .= $mailRes['message'].PHP_EOL;
}

$log .= "-------------------Session end--------------------".PHP_EOL;
$log .= PHP_EOL;

if (count($data)>0) {
  file_put_contents('process_log.log', $log, FILE_APPEND);
}




?>
