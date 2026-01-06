<?php

function getReferralRecords() {
	$conn = connectDb();
	$stmt = $conn->prepare("SELECT * FROM referrals ORDER BY last_upd DESC;");
	$stmt->execute();
	$result = $stmt->get_result();

	$statistic = [];
	while ($data = $result->fetch_assoc()) {
	    $statistic[] = $data;
	}

	$row = json_encode($statistic, JSON_PRETTY_PRINT);
	closeDB($conn); 

	return $row;
}

function updateReferralStatus($r_mail, $c_mail, $status) {
	$conn = connectDb();
	$stmt = $conn->prepare("UPDATE referrals SET status = ?, last_upd = NOW() WHERE r_mail = ? AND c_mail = ?;");
	$stmt->bind_param("sss", $status, $r_mail, $c_mail);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return true;
	} else {
		return false;
	}
}

function updateReferralBHID($r_mail, $c_mail, $bh_id) {
	$conn = connectDb();
	$stmt = $conn->prepare("UPDATE referrals SET bh_id = ?, last_upd = NOW() WHERE r_mail = ? AND c_mail = ?;");
	$stmt->bind_param("sss", $bh_id, $r_mail, $c_mail);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return true;
	} else {
		return false;
	}
}
?>