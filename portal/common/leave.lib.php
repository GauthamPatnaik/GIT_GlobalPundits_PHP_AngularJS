<?php
include("../common/db.lib.php");
include("../common/session.php");

function workingDays($from, $to) {
	$fromSTR = strtotime($from);
	$toSTR = strtotime($to);
	$workingDays = 0;

	$from =date_create($from);
	$to =date_create($to);

	date_add($from,date_interval_create_from_date_string("-1 days"));
	$fromSTR = strtotime(date_format($from,"Y-m-d"));

	// return date_format($date,"Y-m-d");
	while ($fromSTR != $toSTR) {
		date_add($from,date_interval_create_from_date_string("1 days"));
		$fromSTR = strtotime(date_format($from,"Y-m-d"));

		if (date_format($from,"w") != 6 && date_format($from,"w") != 0) {
			$workingDays += 1;
		}
	}

	return $workingDays;
}

function checkDates($from, $to) {
	$from = date_create($from);
	$to = date_create($to);

	$diff = date_diff($to,$from);

	if ($diff->format("%r%a") <= 0) {
		return true;
	}
	return false;
}

function checkPast($from) {
	$from = date_create($from);
	$today = new DateTime();

	date_add($today,date_interval_create_from_date_string("-10 days"));
	// date_add($from,date_interval_create_from_date_string("-10 days"));
	$diff = date_diff($today,$from);

	if($diff->format("%r%a") >= 0) {
		echo true;
	}
	return false;
}

function checkFuture($to) {
	$to = date_create($to);
	$today = new DateTime();

	date_add($today,date_interval_create_from_date_string("30 days"));
	// date_add($from,date_interval_create_from_date_string("-10 days"));
	$diff = date_diff($today,$to);

	if($diff->format("%r%a") <= 0) {
		echo true;
	}
	return false;
}

function getLeaveBalance($id, $workingDays) {
	$conn = connectDb();
	$stmt = $conn->prepare("SELECT leave_bl FROM leave_balance where id = ?;");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$data = $result->fetch_assoc();

	closeDB($conn); 
	return($data['leave_bl']); 
}

function minusLeaveBalance($approver_id, $id, $days_deducted) {
	$conn = connectDb();
	$stmt = $conn->prepare("UPDATE leave_balance SET leave_bl = leave_bl-?, LDD = NOW(), days_deducted = ?, added_by = ? WHERE id = ?;");
	$stmt->bind_param("ssss", $days_deducted, $days_deducted, $approver_id, $id);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return true;
	} else {
		return false;
	}
}

function addLeaveBalance($approver_id, $id, $days_added) {
	$conn = connectDb();
	$stmt = $conn->prepare("UPDATE leave_balance SET leave_bl = leave_bl+?, LAD = NOW(), days_added = ?, added_by = ? WHERE id = ?;");
	$stmt->bind_param("ssss", $days_added, $days_added, $approver_id, $id);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return true;
	} else {
		return false;
	}
}

?>