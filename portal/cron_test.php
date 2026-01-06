<?php
include("common/db.lib.php");
require('vendor/autoload.php');
include("common/mail.lib.php");

use Medoo\Medoo;

$db = medoo('lobalpun_portal');

// Validate attendance today's records -
$attQuery = "UPDATE att_live SET status = CASE WHEN (DAYOFWEEK(date_in) = 1 OR DAYOFWEEK(date_in) = 7) AND (status <> 'OUT' OR status <> 'IN') THEN 'Weekend' WHEN status = 'OUT' THEN 'Present' WHEN status = 'IN' THEN 'Status unknown' WHEN status = 'Status unknown' THEN 'Absent' ELSE 'Status unknown' END;";

$db->query("UPDATE daily_flag SET date = CURRENT_DATE, flag = '0000'; ");
$db->query($attQuery);
$db->query("UPDATE daily_flag SET flag = '1000' WHERE date = CURRENT_DATE; ");

// Process Att records
$db->query("INSERT INTO att_record (SELECT * FROM att_live);");
$db->query("UPDATE daily_flag SET flag = '1100' WHERE date = CURRENT_DATE;");
$db->query("TRUNCATE TABLE att_live;");
$db->query("INSERT INTO att_live (SELECT id, CURRENT_DATE, '00:00:00', NULL, '00:00:00', 'Status unknown' from emp_details WHERE status <> 'N')");
$db->query("UPDATE daily_flag SET flag = '1111' WHERE date = CURRENT_DATE;");

// send email notification to employees
$data = $db->query("SELECT A.id, A.officialid, A.firstname, A.lastname, B.date_in, B.status FROM emp_details A, att_record B WHERE A.id = B.id AND B.date_in = CURRENT_DATE - 1 AND B.status in ('Status unknown', 'Absent') AND A.country <> 'USA' AND A.status <> 'N'")->fetchAll();

for($i=0;$i<count($data);$i++) {
  $heading = "Your status is '".$data[$i]['status']."' for date : ".$data[$i]['date_in'];
  
  $body = "Dear ".$data[$i]['lastname'].", ".$data[$i]['firstname']."<br><br>";
  if ($data[$i]['status']=='Status unknown') {
    $body .= 'You have missed to sign out yesterday, Please login to the GP Portal and raise a request to rectify the attendance record. The record will be updated post approval.<br><br>';
  } else {
    $body .= 'You have not signed in yesterday. If incorrect, raise a request to modify the attendace records. The record will be updated post approval<br><br>';
  }
  $body .= "Date - ".$data[$i]['date_in']."<br>";
  $body .= "Status - ".$data[$i]['status']."<br>";
  $body .= "Link - <a href='https://login.globalpundits.com/#!/Modify_Attendance' target='_blank'>GP Portal</a><br><br>";
    
  $subject = "Attendace status '".$data[$i]['status']."' for date : ".$data[$i]['date_in'];
  
  $mailBody = new emailTemplate();
  $mailBody->setHeading($heading);
  $mailBody->setBody($body);
  
  $mailTo = $data[$i]['officialid'];
  $mailer1 = new sendMail();
  $mailer1->setTo($mailTo);
  $mailer1->setContent($subject, $mailBody->getTemplate());
  $mailRes = $mailer1->send();
}

$mailTo = "ash@globalpundits.com";
$mailer = new sendMail();
$mailer->setTo($mailTo);
$mailer->setContent("Attendance Cosolidation", "Attendance consolidated successfully");
$mailRes = $mailer->send();
?>