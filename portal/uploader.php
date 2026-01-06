<?php
//Path to autoload.php from current location
require_once './vendor/autoload.php';

$config = new \Flow\Config();
$config->setTempDir('./chunks_temp_folder');
$request = new \Flow\Request();
$uploadFolder = './uploads/'; // Folder where the file will be stored
$uploadFileName = uniqid()."_".$request->getFileName(); // The name the file will have on the server
$uploadPath = $uploadFolder.$uploadFileName;
if (\Flow\Basic::save($uploadPath, $config, $request)) {
  // file saved successfully and can be accessed at $uploadPath
//   unlink($uploadPath);
  
  $resp = array(
      'success' => true,
      'message' => 'upload successful',
      'file' => $uploadFileName
  );
  echo json_encode($resp);
} else {
  // This is not a final chunk or request is invalid, continue to upload.
}
?>