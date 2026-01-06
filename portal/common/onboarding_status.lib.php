<?php

function addOnboardingStatus($envelopeID, $bhID, $client, $name, $mailID, $phone, $estatus, $mstatus, $message, $sentby) {
	$conn = connectDb();
	$stmt = $conn->prepare("INSERT INTO onboarding_status (envelopeID, bhID, client, name, mailID, phone, stime, estatus, mstatus, message, sentby) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?);");
	$stmt->bind_param("ssssssssss", $envelopeID, $bhID, $client, $name, $mailID, $phone, $estatus, $mstatus, $message, $sentby);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return $stmt;
	} else {
		return $stmt->error;
	}
}

function onbaordUpdateEstatus($envelopeID, $status, $message) {
	$conn = connectDb();
	$stmt = $conn->prepare("UPDATE onboarding_status SET estatus = ?, message = ? WHERE envelopeID = ?;");
	$stmt->bind_param("sss", $status, $message, $envelopeID);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return true;
	} else {
		return false;
	}
}

function onbaordUpdateBstatus($envelopeID, $status) {
	$conn = connectDb();
	$stmt = $conn->prepare("UPDATE onboarding_status SET bstatus = ? WHERE envelopeID = ?;");
	$stmt->bind_param("ss", $status, $envelopeID);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return true;
	} else {
		return false;
	}
}

function onbaordUpdateMstatus($envelopeID, $status) {
	$conn = connectDb();
	$stmt = $conn->prepare("UPDATE onboarding_status SET mstatus = ? WHERE envelopeID = ?;");
	$stmt->bind_param("sss", $status, $envelopeID);
	$stmt->execute();

	closeDB($conn); 
	if ($stmt->affected_rows == 1) {
		return true;
	} else {
		return false;
	}
}

function getAllOnboardStatusRecords() {
	$conn = connectDb();

	$stmt = $conn->prepare("SELECT * FROM onboarding_status ORDER BY stime DESC LIMIT 30;");
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

function getBHIDFromEnvelopeID($envelopeID) {
	$conn = connectDb();
  
  $sql = "SELECT bhID FROM onboarding_status WHERE envelopeID = '$envelopeID';";
  $result = mysqli_query($conn, $sql);
  if ($result !== false) {
      $value = mysqli_fetch_row($result);
  }
  
	closeDB($conn); 

	return $value[0];
}


function getClientFromEnvelopeID($envelopeID) {
  $conn = connectDb();  
  $sql = "SELECT client FROM onboarding_status WHERE envelopeID = '$envelopeID';";
  $result = mysqli_query($conn, $sql);
  if ($result !== false) {
      $value = mysqli_fetch_row($result);
  }
  closeDB($conn); 
  return $value[0];
}


/* creates a compressed zip file */
function create_zip($files = array(), $fileName = array() ,$destination = '') {

	if(count($files)) {
		$zip = new ZipArchive();
		if($zip->open($destination, (ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE)) !== true) {
			return "Could not create zip";
		}
		// foreach($files as $file) {
		// 	$zip->addFile($file,$file);
		// }

		for ($i=0;$i<count($fileName);$i++) {
			$zip->addFromString($fileName[$i], $files[$i]);
		}
		
		$zip->close();
		
		return file_exists($destination);
	}
	else
	{
		return "File count error";
	}

}
?> 