<?php
header('Access-Control-Allow-Origin: *');  
include("../../common/db.lib.php");
require(__DIR__.'/../../vendor/autoload.php');

use Medoo\Medoo;

$db = medoo('lobalpun_careers');

$post_data = json_decode(file_get_contents("php://input"), true);
// $data = $db->select('open_jobs', '*',$orberBy);
// $data = $db->query("SELECT * FROM open_jobs ORDER BY dateAdded DESC")->fetchAll();

// $data = json_encode($post_data);

$fileExt = explode('.', $post_data[form][file][filename]);
// $fileExt = 'docx';

$row =[
  'firstName' => $post_data[form][firstName],
  'lastName' => $post_data[form][lastName],
  'email' => $post_data[form][mail],
  'phone' => $post_data[form][phone],
  'resumeData' => $post_data[form][file][base64],
  'resumeFileType' => $post_data[form][file][filetype],
  'resumeExtension' => $fileExt[count($fileExt)-1],
  'jobID' => $post_data[form][jobID],
  'status' => 'new',
];
$db = medoo('lobalpun_careers');
$db->insert('job_submissions', $row);

$error_code = $db->error();
if (!isset($error_code[1])) {
  http_response_code(200);
  echo"Applied successfully";
} else {
  http_response_code(400);  
  echo"You've already applied for this job";
}


?>
