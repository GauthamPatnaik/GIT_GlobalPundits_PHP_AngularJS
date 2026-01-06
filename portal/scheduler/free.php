<?php
// require __DIR__ . '/../vendor/autoload.php';

function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

function getBusyFree($email, $minTime, $maxTime) {
  // Get the API client and construct the service object.
  $client = getClient();

  // Print the next 10 events on the user's calendar.
  $cal = new Google_Service_Calendar($client);
  $calendarId = $email;
  //$calendarId = array('narvik.kommune.no_37383343730@resource.calendar.google.com','narvik.kommune.no_2d1383134@resource.calendar.google.com');
  $freebusy_req = new Google_Service_Calendar_FreeBusyRequest();
//   $freebusy_req->setTimeMin('2019-03-18T00:00:00+05:30');
//   $freebusy_req->setTimeMax('2019-03-25T00:00:00+05:30');
  $freebusy_req->setTimeMin($minTime);
  $freebusy_req->setTimeMax($maxTime);


  $item = new Google_Service_Calendar_FreeBusyRequestItem();
  $item->setId($calendarId);
  $freebusy_req->setItems(array($item));
  $query = $cal->freebusy->query($freebusy_req);

  $response_calendar = $query->getCalendars();
  $busy_obj = $response_calendar[$calendarId]->getBusy();
  
  return $busy_obj;
}

// echo"<pre>";
// print_r($busy_obj);
// echo"<pre>";
?>