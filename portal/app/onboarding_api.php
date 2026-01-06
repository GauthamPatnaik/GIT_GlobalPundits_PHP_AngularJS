<?php
include("../common/db.lib.php");
include("../common/session.php");
include("../common/RBAC.lib.php");

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$type = $post_data['type'];

if (checkSession($id, $session_key)){

	if ($type == "checkAuth") {
		$hasPermission = hasOnboardingRole($id);

		if (!$hasPermission) {
			$response = array("message"=>"Not authorized to access page.", "status"=>"0");
		} else {
			$response = array("message"=>"Authorized to access page.", "status"=>"1");
		}

		$response = json_encode($response);

		echo $response;
	}

} else {
	echo"false";
}
?>