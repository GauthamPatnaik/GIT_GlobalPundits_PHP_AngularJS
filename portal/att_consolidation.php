<?php
include("common/db.lib.php");

$conn = connectMutliDb();

// Validate attendance today's record
$liveRecs = "UPDATE daily_flag SET date = CURRENT_DATE, flag = '0000'; ";
$liveRecs .= "UPDATE att_live SET status = 'Absent' WHERE status = 'Status unknown'; ";
$liveRecs .= "UPDATE att_live SET status = 'Present' WHERE status = 'OUT'; ";
$liveRecs .= "UPDATE att_live SET status = 'Status unknown' WHERE status = 'IN'; ";
$liveRecs .= "UPDATE daily_flag SET flag = '1000' WHERE date = CURRENT_DATE; ";
$stmt1 = mysqli_multi_query($conn, $liveRecs);


if ($stmt1==TRUE) {
	echo "Queries executed successfully<br>";

	$conn1 = connectMutliDb();
	$consolidateRecs = "INSERT INTO att_record ";
	$consolidateRecs .= "SELECT * FROM att_live; ";
	$consolidateRecs .= "UPDATE daily_flag SET flag = '1100' WHERE date = CURRENT_DATE; ";
	$consolidateRecs .= "TRUNCATE TABLE att_live; ";
	$consolidateRecs .= "UPDATE att_dup SET date_in = CURRENT_DATE; ";
	$consolidateRecs .= "UPDATE daily_flag SET flag = '1110' WHERE date = CURRENT_DATE; ";
	$consolidateRecs .= "INSERT INTO att_live ";
	$consolidateRecs .= "SELECT * FROM att_dup;";
	$consolidateRecs .= "UPDATE daily_flag SET flag = '1111' WHERE date = CURRENT_DATE; ";

	$stmt2 = mysqli_multi_query($conn1, $consolidateRecs);

	if ($stmt2==TRUE) {
		echo "Attendance consolidated successfully";
	} else {
		echo $consolidateRecs;
	}
	closeDB($conn1);
} else {
	echo "Queries failed";
}
closeDB($conn);
?>