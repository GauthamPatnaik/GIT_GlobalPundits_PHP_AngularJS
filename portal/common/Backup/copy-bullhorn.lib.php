<?php
define('CLIENT_ID', '6c8b8da4-87d5-4f80-972b-53ca7683e0ed');
define('CLIENT_SECRET', 'dw08F6BxP8Se8I11ctTYRcpnuXgI34E4');
define('USER', 'globalpundits.api');
define('PASS', 'Gpundits$10');

// define('STAGE_AUTH', 'auth-west9');
// define('STAGE_REST', 'rest-west9');

define('STAGE_AUTH', 'auth');
define('STAGE_REST', 'rest');

define('PROD_AUTH', 'auth');
define('PROD_REST', 'rest');

function getAuthCode($prod=true)
{
  if ($prod) {
    $url = 'https://'.PROD_AUTH.'.bullhornstaffing.com/oauth/authorize?client_id='.CLIENT_ID.'&response_type=code&action=Login&username='.USER.'&password='.PASS;
  } else {
    $url = 'https://'.STAGE_AUTH.'.bullhornstaffing.com/oauth/authorize?client_id='.CLIENT_ID.'&response_type=code&action=Login&username='.USER.'&password='.PASS;
  }
  
  $curl = curl_init( $url ); 
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HEADER, true);
  //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($curl, CURLOPT_AUTOREFERER, true);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
  curl_setopt($curl, CURLOPT_TIMEOUT, 120);

  $content = curl_exec( $curl );
  
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {
    $authcode = $err;
  }

  //if(preg_match('#Location: (.*)#', $content, $r)) {
  //$l = trim($r[1]);
  //$temp = preg_split("/code=/", $l);
  //$authcode = $temp[1];
  //}

$url_components = parse_url($content); 
parse_str($url_components['query'], $params); 
$authcode=$params['code'];
return $authcode;
}

function doBullhornAuth($authCode, $prod=true)
{
   if ($prod) {
    //$url = 'https://'.PROD_AUTH.'.bullhornstaffing.com/oauth/token?grant_type=authorization_code&code='.$authCode.'&client_id='.CLIENT_ID.'&client_secret='.CLIENT_SECRET;
    $url = 'https://'.PROD_AUTH.'.bullhornstaffing.com/oauth/token?grant_type=authorization_code&code='.$authCode.'&client_id='.CLIENT_ID.'&client_secret='.CLIENT_SECRET;
  
  } else {
     
   // $url = 'https://'.STAGE_AUTH.'.bullhornstaffing.com/oauth/token?grant_type=authorization_code&code='.$authCode.'&client_id='.CLIENT_ID.'&client_secret='.CLIENT_SECRET;
    $url = 'https://'.STAGE_AUTH.'.bullhornstaffing.com/oauth/token?grant_type=authorization_code&code='.$authCode.'&client_id='.CLIENT_ID.'&client_secret='.CLIENT_SECRET;

  }

  $options = array(
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => array()
  ); 

  $ch = curl_init( $url ); 
  curl_setopt_array( $ch, $options ); 
  $content = curl_exec( $ch ); 

  curl_close( $ch ); //die($content);
  return $content;

}

function bullhornRefreshToken($refCode, $prod=true)
{
  if ($prod) {
    $url = 'https://'.PROD_AUTH.'.bullhornstaffing.com/oauth/token?grant_type=refresh_token&refresh_token='.$refCode.'&client_id='.CLIENT_ID.'&client_secret='.CLIENT_SECRET;
  } else {
    $url = 'https://'.STAGE_AUTH.'.bullhornstaffing.com/oauth/token?grant_type=refresh_token&refresh_token='.$refCode.'&client_id='.CLIENT_ID.'&client_secret='.CLIENT_SECRET;
  }

  $options = array(
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => array()
  ); 

  $ch = curl_init( $url ); 
  curl_setopt_array( $ch, $options ); 
  $content = curl_exec( $ch ); 

  curl_close( $ch );
  return $content;

}

function doBullhornLogin($accessToken, $prod=true)
{
  if ($prod) {
    $url = 'https://'.PROD_REST.'.bullhornstaffing.com/rest-services/login?version=*&access_token='.$accessToken;
  } else {
    $url = 'https://'.STAGE_REST.'.bullhornstaffing.com/rest-services/login?version=*&access_token='.$accessToken;
  }
//   $url = 'https://rest.bullhornstaffing.com/rest-services/login?version=*&access_token='.$accessToken;
  $curl = curl_init( $url ); 
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  //curl_setopt($curl, CURLOPT_HEADER, true);
  //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  //curl_setopt($curl, CURLOPT_AUTOREFERER, true);
  //curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
  //curl_setopt($curl, CURLOPT_TIMEOUT, 120);

  $content = curl_exec( $curl );
  
  $err = curl_error($curl);
  curl_close( $curl );
  if ($err) {
    return $err;
  }
  return $content;

}

function checkBHSession($session) {
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $session['restUrl']."/ping?BhRestToken=".$session['BhRestToken'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
    ),
  ));

  $response = curl_exec($curl);
  $response = json_decode($response, true);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $t = time();
    $s = floor($response['sessionExpires']/1000);    
    $timeLeft = $s - $t;   
   return $timeLeft;
   
  }
}

function getBullhornAccess() {
  $tokenPath = __DIR__.'/BullhornAccess.json';
  $sessionPath = __DIR__.'/BullhornSession.json';
  
 if (file_exists($sessionPath)) {
   $session = json_decode(file_get_contents($sessionPath), true);
    
   $ping = json_decode(checkBHSession($session), true);
    if ($ping > 600) {
    return $session;
   }
  }
  
  if (file_exists($tokenPath)) {
      $accessToken = json_decode(file_get_contents($tokenPath), true);
  } else {
    $authCode = getAuthCode();    
    buildBullHornLog("AuthCode",$authCode);
    $auth = doBullhornAuth($authCode);
    buildBullHornLog("Auth",$auth);
    $accessToken = json_decode($auth, true);

    file_put_contents($tokenPath, $auth);
    
    $login = json_decode(doBullhornLogin($accessToken['access_token']), true);
    buildBullHornLog("Login ",$login );
    return $login;
  }
  
  $accessToken = json_decode(bullhornRefreshToken($accessToken['refresh_token']), true);
  
 if ($accessToken['error'] || $accessToken==null) {
    $authCode = getAuthCode();    
    buildBullHornLog("AuthCode",$authCode);
    $auth = doBullhornAuth($authCode);
    buildBullHornLog("Auth",$auth);
    $accessToken = json_decode($auth, true);

    file_put_contents($tokenPath, $auth);
  }
  
  $login = json_decode(doBullhornLogin($accessToken['access_token']), true);
  buildBullHornLog("Login ",$login );
  file_put_contents($sessionPath, json_encode($login));
  return $login;
} 

function uploadSignedDocuments($BhRestToken, $restUrl, $files, $fileNames, $bhID) {
  
  $fileID = "";
  for ($i=0;$i<count($fileNames);$i++) {
		$curl = curl_init();

    $postFields = array (
      'externalID' => 'onboarding',
      'fileContent' => base64_encode($files[$i]),
      'fileType' => 'SAMPLE',
      'name' => $fileNames[$i],
      'contentType' => 'pdf',
      'description' => 'Signed onboarding document',
    );

    curl_setopt_array($curl, array(
      CURLOPT_URL => $restUrl."file/Candidate/".$bhID,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PUT",
      CURLOPT_POSTFIELDS => json_encode($postFields),
      CURLOPT_HTTPHEADER => array(
        "bhresttoken: ".$BhRestToken,
        "Content-Type: application/json",
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      $fileID = false;
    } else {
      $fileID .= $response['fileId'];
    }
    if ($i!=count($fileNames)-1) {
      $fileID .= ",";
    }
//     error_log($fileID);
	}
  
  return $fileID;
}

function checkCandidate($BhRestToken, $restUrl, $firstname, $lastname, $mail) {
  $curl5 = curl_init();

  curl_setopt_array($curl5, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $restUrl.'search/Candidate?count=3&query=firstName:'.$firstname.'+AND+lastName:'.$lastname.'+AND+email:'.$mail.'&fields=id,firstName,lastName,email',
  ));

  curl_setopt($curl5, CURLOPT_HTTPHEADER, array('BhRestToken: '.$BhRestToken.''));
  curl_setopt($curl5, CURLOPT_RETURNTRANSFER, TRUE);

  $resp3 = curl_exec($curl5);
  $resp3 = json_decode($resp3, true);

  $err = curl_error($curl5);
  curl_close($curl5);
  
  if ($resp3['data'][0]['firstName'] == $firstname && $resp3['data'][0]['lastName'] == $lastname && $resp3['data'][0]['email'] == $mail) {
    return $resp3['data'][0]['id'];
  } else {
    return false;
  }
}

function addCandidate($BhRestToken, $restUrl, $data, $desc) {
  $curl = curl_init();
  
  $post_fields = [
    'firstName' => $data['firstName'],
    'lastName' => $data['lastName'],
    'name' => $data['firstName'].' '.$data['lastName'],
    'email' => $data['email'],
    'description' => $desc,
    'phone' => $data['phone'],
     'gender' => $data['gender'],
    'ethnicity' => $data['ethnicity'],
    'veteran' => $data['veteran'],
    'disability' => $data['disability'],
    'customText11'=> 'Website'
	     
  ];
  $post_fields = json_encode($post_fields);

  curl_setopt_array($curl, array(
    CURLOPT_URL => $restUrl."entity/Candidate",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => $post_fields,
    CURLOPT_HTTPHEADER => array(
      "BhRestToken: ".$BhRestToken,
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
//     echo"<pre>";
//     print_r(json_decode($response, true));
//     echo"</pre>";
    $response = json_decode($response, true);
    return $response['changedEntityId'];
  }
}

function uploadCandidateResume($BhRestToken, $restUrl, $file, $fileType, $bhID) {
  
  $fileID = "";
  $curl = curl_init();

  $postFields = array (
    'externalID' => 'Career page applicant',
    'fileContent' => $file,
    'fileType' => 'SAMPLE',
    'name' =>  $bhID.'_resume',
    'contentType' => $fileType,
    'description' => 'Candidate resume'
  );

  curl_setopt_array($curl, array(
    CURLOPT_URL => $restUrl."file/Candidate/".$bhID,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => json_encode($postFields),
    CURLOPT_HTTPHEADER => array(
      "bhresttoken: ".$BhRestToken,
      "Content-Type: application/json",
    ),
  ));

  $response = curl_exec($curl);
  $response = json_decode($response, true);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
     return false;
  }
  return $response;
}

function submitJob($BhRestToken, $restUrl, $cid, $jid) {
  $curl = curl_init();
  
  $post_fields = [
    "candidate" => [
      "id" => $cid,
    ],
    "jobOrder" => [
      "id" => $jid,
    ],
    "status" => "New Lead",
    "dateWebResponse" => time(),
  ];
  $post_fields = json_encode($post_fields);

  curl_setopt_array($curl, array(
    CURLOPT_URL => $restUrl."entity/JobSubmission",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => $post_fields,
    CURLOPT_HTTPHEADER => array(
      "BhRestToken: ".$BhRestToken,
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
//     echo"<pre>";
//     print_r(json_decode($response, true));
//     echo"</pre>";
    $response = json_decode($response, true);
    return $response['changedEntityId'];
  }
}

function parseResume($BhRestToken, $restUrl, $file, $ext, $file_type) {
  
  $curl = curl_init();

  $file_content = base64_decode($file);
  $file_name = "resume.".$ext;
  
  file_put_contents($file_name, $file_content);
  
  // Works with 5.5 greater version
  //$file = new CURLFile(realpath($file_name), $file_type, $file_name);

  // Changes Made By Gautham for below php version 5.5 
  $file = curl_file_create(realpath($file_name), $file_type, $file_name);

  $data = array('file' => $file);

//   print_r($file);
  
  curl_setopt_array($curl, array(
//     CURLOPT_URL => $restUrl."resume/parseToCandidate?format=text&populateDescription=html",
    CURLOPT_URL => $restUrl."resume/convertToHtml?format=".$ext,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      "bhresttoken: ".$BhRestToken,
      "Content-Type: multipart/form-data",
    ),
  ));

  $response = curl_exec($curl);
  $response = json_decode($response, true);
  $err = curl_error($curl);

  curl_close($curl);
  
  unlink($file_name);
    
  if ($err) {
    return $err;
  } else {
    return $response['html'];
//     return $response;
  }
}

//Created Method to get actual file path(Gautham)
/**
 * Create CURLFile object
 * @param string $name File name
 * @param string $mimetype Mime type, optional
 * @param string $postfilename Post filename, defaults to actual filename
 */
function curl_file_create($filename, $mimetype = '', $postname = 'Resume')
{
  return "@$filename;filename=". ($postname ?: basename($filename)). ($mimetype ? ";type=$mimetype" : '');
}


function getCandidateFromTearsheet($BhRestToken, $restUrl, $tname) {
  $curl5 = curl_init();

  $can_id = 'Job #11240 | Business Analyst - Project Lead';
  $can_id = urlencode($can_id);
  $feilds = 'candidates(email),name,id';

  curl_setopt_array($curl5, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $restUrl."query/Tearsheet?fields=".$feilds."&where=name='".urlencode($tname)."'&count=3",
  ));

  curl_setopt($curl5, CURLOPT_HTTPHEADER, array('BhRestToken: '.$BhRestToken.''));
  curl_setopt($curl5, CURLOPT_RETURNTRANSFER, TRUE);
  
  $resp3 = curl_exec($curl5);
  
  $err = curl_error($curl5);
  curl_close($curl5);
  
  if ($err) {
    return $err;
  } else {
    return $resp3;
  }
}

function getCandidateByID($BhRestToken, $restUrl, $id) {
  $curl5 = curl_init();

//   $can_id = 'Job #11240 | Business Analyst - Project Lead';
  $id = urlencode($id);
  $feilds = 'email,firstName,lastName,id';

  curl_setopt_array($curl5, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $restUrl."entity/Candidate/".$id."?fields=".$feilds."&count=3",
  ));

  curl_setopt($curl5, CURLOPT_HTTPHEADER, array('BhRestToken: '.$BhRestToken.''));
  curl_setopt($curl5, CURLOPT_RETURNTRANSFER, TRUE);
  
  $resp3 = curl_exec($curl5);
  
  $err = curl_error($curl5);
  curl_close($curl5);
  
  if ($err) {
    return $err;
  } else {
    return $resp3;
  }
}

function addNote($BhRestToken, $restUrl,$bhID, $comments, $action) {
  $curl = curl_init();

  $postFields = [
    'comments' => $comments,
    'action' => $action,
    'personReference' => [
      'id' => $bhID,
      '_subtype' => 'Candidate'
    ]
  ];

  curl_setopt_array($curl, array(
    CURLOPT_URL => $restUrl."entity/Note",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => json_encode($postFields),
    CURLOPT_HTTPHEADER => array(
      "bhresttoken: ".$BhRestToken,
      "Content-Type: application/json",
    ),
  ));

  $response = curl_exec($curl);
  $response = json_decode($response, true);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    print_r($err);
    die();
  }
  
  return $response['changedEntityId'];
//   return $response;

}


//Captures log

function buildBullHornLog($type,$m){
    $errorInString=print_r($m, true);
    $errorLogPath = __DIR__.'/BullhornErrorLog.txt';
    date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
    $message="Logged: [".date('d-m-Y H:i:s')."] - ".$type.": ".$errorInString.", \n\n\n";
    file_put_contents($errorLogPath, $message, FILE_APPEND);
}



?>