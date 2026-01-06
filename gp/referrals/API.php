<?php
define('CLIENT_ID', '6c8b8da4-87d5-4f80-972b-53ca7683e0ed');
define('CLIENT_SECRET', 'dw08F6BxP8Se8I11ctTYRcpnuXgI34E4');
define('USER', 'globalpundits.api');
define('PASS', 'Gpundits$10');

function getAuthCode() {
    $url = 'https://auth.bullhornstaffing.com/oauth/authorize?client_id='.CLIENT_ID.'&response_type=code&action=Login&username='.USER.'&password='.PASS;
    $curl = curl_init( $url ); 
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_AUTOREFERER, true);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
    curl_setopt($curl, CURLOPT_TIMEOUT, 120);

    $content = curl_exec( $curl );
    curl_close( $curl );

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

function doBullhornAuth($authCode) {
    $url = 'https://auth.bullhornstaffing.com/oauth/token?grant_type=authorization_code&code='.$authCode.'&client_id='.CLIENT_ID.'&client_secret='.CLIENT_SECRET;


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

function doBullhornLogin($accessToken) {
    $url = 'https://rest.bullhornstaffing.com/rest-services/login?version=*&access_token='.$accessToken;
    $curl = curl_init( $url ); 
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $content = curl_exec( $curl );
    curl_close( $curl );
    return $content;
}

function checkCandidate($rest_token, $rest_url , $c_mail) {
    $curl3 = curl_init();
    
    curl_setopt_array($curl3, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $rest_url."search/Candidate?query=email:".$c_mail."&fields=id,username,firstName,lastName,email,status,phone&count=1&start=0"
    ));

    curl_setopt($curl3, CURLOPT_HTTPHEADER, array('BhRestToken: '.$rest_token.''));
    curl_setopt($curl3, CURLOPT_RETURNTRANSFER, TRUE);
    $resp = curl_exec($curl3);
    
    curl_close($curl3);
    $resp = json_decode($resp,true);
    
    if (isset($resp['data'][0]['_score'])) {
        $score = $resp['data'][0]['_score'];
    } else {
        $score = 0;
    }
    return $score;
}

function checkStatus($rest_token, $rest_url , $bh_id) {
    $curl3 = curl_init();
    curl_setopt_array($curl3, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $rest_url."search/JobSubmission?query=candidate.id:".$bh_id."&fields=status,id",
    ));

    curl_setopt($curl3, CURLOPT_HTTPHEADER, array('BhRestToken: '.$rest_token.''));
    curl_setopt($curl3, CURLOPT_RETURNTRANSFER, TRUE);
    $resp1 = curl_exec($curl3);
    curl_close($curl3);
    $resp1 = json_decode($resp1,true);
    if (isset($resp1['data'][0]['status'])) { 
        $i=10;
        while ($i>-1) {
            if (($resp1['data'][$i]['status'])=="") {
                $i=$i-1;
            }
            else {
                $stat = $resp1['data'][$i]['status'];
                $i=-1;
            }
        }
    }
    else {
        $stat = "zero";
    }

    return $stat;
}

?>