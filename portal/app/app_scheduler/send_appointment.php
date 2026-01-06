<?php
include(__DIR__."/../../common/db.lib.php");
include(__DIR__."/../../common/session.php");
include(__DIR__."/../../common/bullhorn.lib.php");
include(__DIR__."/../../common/mail.lib.php");

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];

if (checkSession($id, $session_key)){
//     $subject = $post_data['subject'];
//     $desc = $post_data['desc'];
    $ques = $post_data['ques'];
    $appData = $post_data['appData'];

    $db = medoo('lobalpun_portal');
    $sent_by = $db->query("SELECT officialid from emp_details WHERE ID = '".$id."';")->fetchAll();

    foreach ($appData as $row) {
        $appID = uniqid(true);
        $dbArray = [
            'id' => $appID,
            'bhid' => $row['id'],
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
            'email' => $row['email'],
            'sent_by' => $sent_by[0][0],
            'questions' => serialize($ques),
            'status' => 'sent'
        ];
        
        $db->insert('app_scheduler', $dbArray);
      
        //     mail logic  
        $subject = $post_data['subject'];
        $heading = $subject;
        $body = $post_data['desc'];
        $body .= "<br><br><a href='https://www.globalpundits.com/appointment/#!/id/".$appID."' target='_blank'>Click here to schedule an appointment</a><br><br>";    

        $mailBody = new emailTemplate();
        $mailBody->setHeading($heading);
        $mailBody->setBody($body);

  //       $mailTo = $row['email'];
        $mailTo = 'ashfaqrox1@gmail.com';
        $mailer1 = new sendMail();
        $mailer1->setTo($mailTo);
        $mailer1->setContent($subject, $mailBody->getTemplate());
        $mailRes = $mailer1->send();
    }
    
    echo 'success';
}
else {
	echo "Session failed";
}
?>