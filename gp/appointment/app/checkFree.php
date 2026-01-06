<?php
header('Access-Control-Allow-Origin: *');  
include(__DIR__."/../../../portal/common/db.lib.php");
require(__DIR__.'/../../../portal/vendor/autoload.php');
include(__DIR__."/../../../portal/scheduler/free.php");

use Medoo\Medoo;

$db = medoo('lobalpun_portal');

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['appID'];
$minTime = $post_data['minTime'];
$maxTime = $post_data['maxTime'];

$data = $db->query("SELECT sent_by from app_scheduler WHERE id = '".$id."';")->fetchAll();
$email = $data[0]['sent_by'];

$free = getBusyFree($email, $minTime, $maxTime);

echo json_encode($free);

?>