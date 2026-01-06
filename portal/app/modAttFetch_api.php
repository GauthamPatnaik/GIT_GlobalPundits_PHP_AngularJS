<?php
include("../common/db.lib.php");
include("../common/session.php");
include("../common/att_modify.lib.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$type = $post_data['type'];

if (checkSession($id, $session_key)){

	if ($type == 'getRecord') {
		$recDate = $post_data['recDate'];

		$conn = connectDb();
		$stmt = $conn->prepare("SELECT * FROM att_record WHERE ID = ? AND date_in = ? ;");
		$stmt->bind_param("ss", $id, $recDate);
		// $stmt->bind_param("s", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		$statistic = [];
		while ($data = $result->fetch_assoc()) {
		    $statistic[] = $data;
		}

		$row = json_encode($statistic);

		echo($row); 
		closeDB($conn); 
	}
	else if ($type == 'attData') {
		$conn = connectDb();

		$stmt = $conn->prepare("SELECT * FROM att_record WHERE ID = ? AND (date_in BETWEEN ? AND ?);");
		$stmt->bind_param("sss", $id, $from_date, $to_date);
		$stmt->execute();
		$result = $stmt->get_result();

		// $row = $result->fetch_assoc();
		
		$statistic = [];
		while ($data = $result->fetch_assoc()) {
		    $statistic[] = $data;
		}

		$row = json_encode($statistic, JSON_PRETTY_PRINT);

		echo($row); 

	}
	else if ($type == 'submittedData') {
		$row = getAttModRecordByID($id);
		echo $row;
	}

}
else {
	echo "Session failed";
}
?>