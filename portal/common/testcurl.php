<?php

define('CLIENT_ID', '6c8b8da4-87d5-4f80-972b-53ca7683e0ed');
define('CLIENT_SECRET', 'dw08F6BxP8Se8I11ctTYRcpnuXgI34E4');
define('USER', 'globalpundits.api');
define('PASS', 'Gpundits$10');


define('STAGE_AUTH', 'auth');
define('STAGE_REST', 'rest');

define('PROD_AUTH', 'auth');
define('PROD_REST', 'rest');


$url = 'https://rest.bullhornstaffing.com/oauth/authorize?client_id=6c8b8da4-87d5-4f80-972b-53ca7683e0ed&response_type=code&action=Login&username=globalpundits.api&password=Gpundits$10';
$ch = curl_init($url);
// Set options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, true);
// Execute cURL session
$response = curl_exec($ch); 
// Check for errors
if(curl_errno($ch)){
    echo 'Curl error: ' . curl_error($ch);
}
// Get effective URL after redirection
$effectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
// Close cURL session
curl_close($ch);
$url_components = parse_url($effectiveUrl); 
parse_str($url_components['query'], $params); 
$authCode=$params['code'];
echo json_encode($authCode);
echo "<br><br>";    echo "<br><br>";
//-------------------------------------------------------------------------------------------------

echo doBullhornAuth($authCode)." Test Result";
echo "<br><br>";

 function doBullhornAuth($authCode) {
        // Set Bullhorn credentials and authentication URL
        $clientId = CLIENT_ID;
        $clientSecret = CLIENT_SECRET;
        $authUrl = 'https://' . PROD_AUTH . '.bullhornstaffing.com/oauth/token';
    
        // Prepare query parameters
        $queryParams = http_build_query(array(
            'grant_type' => 'authorization_code',
            'code' => $authCode,
            'client_id' => $clientId,
            'client_secret' => $clientSecret
        ));
    
        // Construct the full URL with query parameters
        $url = $authUrl . '?' . $queryParams;
         echo $url;
echo "<br><br>";
        // Initialize cURL session
        $ch = curl_init($url);
    
        // Set options for POST request
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification (use only for debugging)
            CURLOPT_VERBOSE => true, // Enable verbose output for debugging
        );
        curl_setopt_array($ch, $options);
    
        // Execute cURL session
        $content = curl_exec($ch);
    
        // Check for errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            // Output verbose information if debugging is enabled
            if (defined('CURLOPT_VERBOSE') && curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
                echo 'HTTP response code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "\n";
                echo 'Verbose output: ' . $content . "\n";
            }
        }
    
        // Close cURL session
        curl_close($ch);
    
        return $content;
    }
    



?>