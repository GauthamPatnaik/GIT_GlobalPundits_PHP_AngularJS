<?php
include("../common/db.lib.php");
include("../common/session.php");

function checkLeaveRequest($id, $from, $to) {
	$conn = connectDb();
	$stmt = $conn->prepare("SELECT * FROM `leave_request` WHERE ID = ? AND status <> 'Cancelled' AND (? BETWEEN from_dt AND to_dt OR ? BETWEEN from_dt AND to_dt) AND ((? = from_dt OR ? = to_dt) OR (? = from_dt OR ? = to_dt));");
	$stmt->bind_param("sssssss", $id, $from, $to, $from, $from, $to, $to);
	$stmt->execute();
	$result = $stmt->get_result();
	
	$statistic = [];
	while ($data = $result->fetch_assoc()) {
	    $statistic[] = $data;
	}

	closeDB($conn);

	if (sizeof($statistic)>0) {
		return false;
	} else {
		return true;
	}
}

function submitLeaveRequest($id, $from, $to, $reason) {
	$conn = connectDb();
	$stmt = $conn->prepare("INSERT INTO leave_request (ID, from_dt, to_dt, reason, DOS, status) VALUES (?, ?, ?, ?, NOW(), 'Pending');");
	$stmt->bind_param("ssss", $id, $from, $to, $reason);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return true;
	} else {
		return false;
	}
}

function rejectLeaveRequest($row_id, $id) {
	$conn = connectDb();
	$stmt = $conn->prepare("UPDATE leave_request SET status = 'Rejected', approver_id = ?, DOA = NOW() WHERE row_id = ?;");
	$stmt->bind_param("ss", $id, $row_id);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return true;
	} else {
		return false;
	}
}

echo(rejectLeaveRequest('2001', 'GP001'));
?>