<?php
include("../common/db.lib.php");
include("../common/session.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$oldPass = $post_data['oldPass'];
$newPass = $post_data['newPass'];

if (checkSession($id, $session_key)){

	$conn = connectDb();
	$stmt = $conn->prepare("SELECT * FROM login_table where ID = ?; ");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = $result->fetch_assoc();

	if ($data['password']!= $oldPass) {
		$return = array('status'=>'match failed');
	} elseif ($data['password']== $newPass) {
		$return = array('status'=>'same pass');
	}
	else {
		$stmt1 = $conn->prepare("UPDATE login_table SET password = ? WHERE id = ?");
		$stmt1->bind_param("ss", $newPass, $id);
		if ($stmt1->execute()) {
			$stmt2 = $conn->prepare("UPDATE login_book SET first_login = 'n' WHERE id = ?");
			$stmt2->bind_param("s", $id);
			
			if ($stmt2->execute()) {
				$return = array('status'=>'success');
			}
		}
	}
	
	closeDB($conn);
	$return = json_encode($return);
	echo $return;

}
else {
	echo "Session failed";
}
?>