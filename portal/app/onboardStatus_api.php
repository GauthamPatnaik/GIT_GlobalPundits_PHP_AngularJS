<?php
include("../common/db.lib.php");
include("../common/session.php");
include("../common/docusign.lib.php");
include("../common/onboarding_status.lib.php");

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$type = $post_data['type'];

if (checkSession($id, $session_key)){

	if ($type == 'allRecords') {
		echo getAllOnboardStatusRecords();
	}

}
else {
	echo "Session failed";
}
?>