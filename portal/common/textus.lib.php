<?php
function sendSMS($to, $content) {
  $infoArray = array(
    "sender" => "atif@globalpundits.com",
    "receiver" => $to,
    "content" => $content
  );
  
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://app.textus.com/api/messages",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($infoArray),
    CURLOPT_HTTPHEADER => array(
      "authorization: Basic YXRpZkBnbG9iYWxwdW5kaXRzLmNvbTpiTlgxVGY1RzRDbHk4d2o4RGpYTG1nMEFiRmc=",
      "cache-control: no-cache",
      "content-type: application/json",
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return false;
  } else {
    echo true;
  }
  
}
?>