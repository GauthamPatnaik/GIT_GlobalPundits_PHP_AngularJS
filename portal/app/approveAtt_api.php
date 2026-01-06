<?php
include("../common/db.lib.php");
include("../common/session.php");
include("../common/RBAC.lib.php");
include("../common/att_modify.lib.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$type = $post_data['type'];

if (checkSession($id, $session_key)){

	$role = hasAttRole($id);
	$approvalRole = getRole($id);
	// $role = hasAttRole('GP002');
	if ($type == "authCheck") {
		if (!$role) {
			$perm = array('auth'=>'false');
			echo json_encode($perm);
		} else {
			$perm = array('auth'=>$role);
			echo json_encode($perm);
		}
	}

	if ($type == "attApprovalRecords") {
		if ($role) {
			$records = getAttModRecordByRole($role);

			echo $records;
		}
	} 

	if ($type == "approveRequest") {
		if ($role) {
			$req_id = $post_data['req_id'];
			$remark = $post_data['remark'];

			$records = acceptAttModRequest($req_id, $remark);

			echo $records;
		}
	}
	if ($type == "rejectRequest") {
		if ($role) {
			$req_id = $post_data['req_id'];
			$remark = $post_data['remark'];

			$records = rejectAttModRequest($req_id, $remark);

			echo $records;
		}
	}

}
else {
	echo "Session failed";
}
?>