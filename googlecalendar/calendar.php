<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Esami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  <link rel="stylesheet" type="text/css" href="style.css">
    <div class="text-center">
      <iframe src="https://calendar.google.com/calendar/embed?src=jubhm5mu5pcqg17t9hpi4744l0%40group.calendar.google.com&ctz=Europe%2FRome" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    </div>
</head>
<body>
    <div class="text-center">
        
    </div>

<?php
require_once 'vendor/autoload.php';

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
$client = new Google_Client();
//The json file you got after creating the service account
putenv('GOOGLE_APPLICATION_CREDENTIALS=calendario-esami-28213d4c056d.json');
$client->useApplicationDefaultCredentials();
$client->setApplicationName("Calendario Esami");
$client->setScopes(Google\Service\Calendar::CALENDAR);
//$client->setAuthConfig('credentials.json');
$client->setAccessType('offline');
//$client->addScope(Google\Service\Drive::DRIVE);
//$client->setPrompt('select_account consent');
//$client->setApprovalPrompt('force');
//$redirect_uri = 'http://localhost:8080';
//$client->setRedirectUri($redirect_uri);

/* $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google\Service\Sheets::SPREADSHEETS_READONLY);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->addScope(Google\Service\Drive::DRIVE);
    $client->setPrompt('select_account consent');
    $redirect_uri = 'http://localhost:8080';
    $client->setRedirectUri($redirect_uri); */

$service = new Google\Service\Calendar($client);

$calendarList = $service->calendarList->listCalendarList();

$event = new Google\Service\Calendar\Event(array(
    'summary' => 'Test Event',
    'description' => 'Test Event',
    'start' => array(
      'dateTime' => '2018-06-02T09:00:00-07:00'
    ),
    'end' => array(
      'dateTime' => '2018-06-10T09:00:00-07:00'
    )
  ));
  
  $calendarId = 'jubhm5mu5pcqg17t9hpi4744l0@group.calendar.google.com';
  $event = $service->events->insert($calendarId, $event);
  printf('Event created: %s\n', $event->htmlLink);
?>
</body>
</html>