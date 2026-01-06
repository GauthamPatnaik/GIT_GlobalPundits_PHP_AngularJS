<?php
include(__DIR__."/../common/db.lib.php");
include(__DIR__."/../common/session.php");

require_once 'vendor/autoload.php';
use \CloudConvert\Api;

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$filename = $post_data['filename'];
$candidateID = $post_data['candidateID'];
$clientName = $post_data['clientName'];

if (checkSession($id, $session_key)) {

	$api = new Api("pvBtjOLmTLrjJsRGrnPmsPVkfg3D3B3PX3GVTuyu2inv5zdufNQbWb7oAH_mxHIYFsC3Ae_ntjUOm_iG2mAxDw");

	$filename_ext = substr($filename, 0, -4);

	$api->convert([
	    "inputformat" => "docx",
	    "outputformat" => "pdf",
	    "input" => "upload",
	    "converteroptions" => [
	        "page_range" => null,
	        "pdf_a" => null,
	        "optimize_print" => true,
	        "input_password" => null,
	        "templating" => null,
	    ],
	    "file" => fopen($clientName.'/converted/'.$filename, 'r'),
	])
	->download($clientName."/converted/".$filename_ext."pdf");

	echo $filename_ext."pdf";
}
?>