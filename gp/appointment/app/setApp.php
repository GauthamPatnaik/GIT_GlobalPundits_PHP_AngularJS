<?php
header('Access-Control-Allow-Origin: *');  
require(__DIR__.'/../../../portal/vendor/autoload.php');
include(__DIR__."/../../../portal/common/db.lib.php");
include(__DIR__."/../../../portal/scheduler/calendarEvent.php");

use Medoo\Medoo;

$db = medoo('lobalpun_portal');

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['appID'];

$data = $db->query("SELECT * from app_scheduler WHERE id = '".$id."';")->fetchAll();

$descString = "";
foreach($post_data['questions'] as $ques) {
    $descString .= $ques['q']." : ".$ques['a'].PHP_EOL;
}

$eventArray = [
    "sent_by" => $data[0]['sent_by'],
    "title" => "Appointment with Globalpundits regd. a job opportunity",
    "start" =>  $post_data['start'],
    "end" => $post_data['end'],
    // "email" => $data[0]['email'],
    "email" => "ashfaqrox1@gmail.com",
    "desc" => $descString
];
$email = $data[0]['sent_by'];

$resp = createEvent($eventArray);

echo json_encode($resp);

?>