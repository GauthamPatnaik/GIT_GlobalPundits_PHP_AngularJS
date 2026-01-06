<?php
include("../common/db.lib.php");
include("../common/session.php");
include("../common/roletest.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$type = $post_data['type'];

if (checkSession($id, $session_key)){
	
	$role = getRole($id);

	$conn = connectDb();
	if ($type == "in") {
		$stmt = $conn->prepare("INSERT INTO att_modify_request (`emp_id`, `type`, `date_in`, `att_in`, `role`) VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssss", $id, $type, $post_data['date_in'], $post_data['att_in'], $role);
	} 
	else if ($type == "out") {
		$stmt = $conn->prepare("INSERT INTO att_modify_request (`emp_id`, `type`, `date_in`, `date_out`, `att_out`, `role`) VALUES (?,?,?,?,?,?)");
		$stmt->bind_param("ssssss", $id, $type, $post_data['date_in'], $post_data['date_out'], $post_data['att_out'], $role);
	}
	else {
		$stmt = $conn->prepare("INSERT INTO att_modify_request (`emp_id`, `type`, `date_in`, `att_in`, `date_out`, `att_out`, `role`) VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssss", $id, $type, $post_data['date_in'], $post_data['att_in'], $post_data['date_out'], $post_data['att_out'], $role);
	}
	
	// $stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();

}
else {
	echo "Session failed";
}
?>