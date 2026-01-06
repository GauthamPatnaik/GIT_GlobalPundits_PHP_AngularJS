<?php
include("../common/db.lib.php");
include("../common/session.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$type = $post_data['type'];

if (checkSession($id, $session_key)){

	if ($type == 'fetch') {
		$conn = connectDb();
		$stmt = $conn->prepare("SELECT * FROM att_live where ID = ?; ");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		$row = $result->fetch_assoc();

		$row = json_encode($row, JSON_PRETTY_PRINT);

		echo($row);
		closeDB($conn); 
	}
	else if ($type == 'MARK') {
		$conn = connectDb();

		$stmt = $conn->prepare("SELECT status FROM att_live WHERE ID = ?;");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		$row = $result->fetch_assoc();

		// $row = json_encode($row, JSON_PRETTY_PRINT);
		if ($row['status'] == 'Status unknown') {
			$stmt = $conn->prepare("UPDATE att_live SET att_in=CURRENT_TIME, status='IN' WHERE ID = ?;");
			$stmt->bind_param("s", $id);
			$result = $stmt->execute();
			$status = "IN";
		} else {
			$stmt = $conn->prepare("UPDATE att_live SET date_out=CURRENT_DATE, att_out=CURRENT_TIME, status='OUT' WHERE ID = ?;");
			$stmt->bind_param("s", $id);
			$result = $stmt->execute();
			$status = "OUT";
		}

		if ($result == true) {
			echo $status;
		}
		

	}

}
else {
	echo "Session failed";
}
?>