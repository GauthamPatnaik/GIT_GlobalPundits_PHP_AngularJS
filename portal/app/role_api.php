<?php
include("../common/db.lib.php");
include("../common/session.php");
include("../common/RBAC.lib.php");

$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$role_id = $post_data['$role_id'];

if (checkSession($id, $session_key)){

	echo hasRole($id, $role_id);

}
else {
	echo "Session failed";
}
?>