<?php
include("../common/db.lib.php");
include("../common/session.php");

// $id = $_POST['userid'];
// $id = "GP001";
$post_data = json_decode(file_get_contents("php://input"), true);
$id = $post_data['id'];
$session_key = $post_data['session_key'];
$from_date = $post_data['fromDate'];
$to_date = $post_data['toDate'];

if (checkSession($id, $session_key)){
  
  $conn = connectDb();

  $stmt = $conn->prepare("SELECT B.*, A.name FROM (SELECT ID, CONCAT(firstname, ' ', lastname) 'name' from emp_details WHERE status = 'Y') A, (SELECT ID, sum(case when status = 'Present' then 1 else 0 end) Present, sum(case when status = 'Absent' then 1 else 0 end) Absent, sum(case when status = 'Status unknown' then 1 else 0 end) SU, sum(case when status = 'Present' then ABS(UNIX_TIMESTAMP(CONCAT(date_out,' ',att_out)) - UNIX_TIMESTAMP(CONCAT(date_in,' ',att_in))) else 0 end) avg_time from att_record WHERE (date_in BETWEEN ? AND ?) GROUP BY ID ) B WHERE A.ID = B.ID AND A.ID NOT IN ('GP001', 'GP1001', 'GP1002');");
  $stmt->bind_param("ss", $from_date, $to_date);
  $stmt->execute();
  $result = $stmt->get_result();

  // $row = $result->fetch_assoc();

  $statistic = [];
  while ($data = $result->fetch_assoc()) {
      $statistic[] = $data;
  }

  $row = json_encode($statistic, JSON_PRETTY_PRINT);

  echo($row); 
  closeDB($conn); 

}
else {
	echo "Session failed";
}
?>