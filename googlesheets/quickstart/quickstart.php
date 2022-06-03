<?php

use Google\Service\Dfareporting\Resource\Files;

require __DIR__ . '/vendor/autoload.php';


//if (php_sapi_name() != 'cli') {
//    throw new Exception('This application must be run on the command line.');
//}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google\Service\Sheets::SPREADSHEETS_READONLY);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->addScope(Google\Service\Drive::DRIVE);
    $client->setPrompt('select_account consent');
    $redirect_uri = 'http://localhost:8080';
    $client->setRedirectUri($redirect_uri);

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


// Get the API client and construct the service object.
$client = getClient();
$service = new Google\Service\Sheets($client);

//$service.Files.copy('1pTllrgCItC5Ox-aUlTzy641OOKtgMCmb',"convert",{"title": "specifyName"});
//service.files().copy(fileId=file_id,convert=true, body={"title": "specifyName"}).execute()

// Prints the names and majors of students in a sample spreadsheet:
// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
$spreadsheetId = '1GCKRr9UZiMsca2LlyH3CDUrwm2eCLwq47b8fY0fG-z4'; //example
$example="1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms";
//$spreadsheetId = '1pTllrgCItC5Ox-aUlTzy641OOKtgMCmb';
$range = 'A1:A2';
/*echo"
<script>
    alert('nello script di quickstart, pre response');
    var body = {\"title\": \"specifyName\"};
    var req = gapi.client.drive.files.copy({
        'fileId': '1pTllrgCItC5Ox-aUlTzy641OOKtgMCmb',
        'convert':true,
        'resource': body
    });
    req.execute(function(resp) {
        console.log('Copy ID: ' + resp.id);
    });

    // Creating a cookie after the document is ready
$(document).ready(function () {
    createCookie(\"sheetid\", \"0\", \"1\");
});
   
// Function to create the cookie
function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = \"; expires=\" + date.toGMTString();
    }
    else {
        expires = \"\";
    }
      
    document.cookie = escape(name) + \"=\" + 
        escape(value) + expires + \"; path=/\";
}
</script>
";*/
echo $_POST['corso'];
//$request=$_COOKIE["sheetid"];
//$dest=new Google\Service\Sheets();
//copyFile($service, "https://docs.google.com/spreadsheets/d/1pTllrgCItC5Ox-aUlTzy641OOKtgMCmb/edit#gid=1054856218",$dest);

$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();



if (empty($values)) {
    print "No data found.\n";
} else {
    print "Name, Major:\n";
    foreach ($values as $row) {
        // Print columns A and E, which correspond to indices 0 and 4.
        printf("%s\n", $row[0]);
    }
}
