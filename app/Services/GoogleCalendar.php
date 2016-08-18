<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class GoogleCalendar
{

    protected $client;

    protected $service;

    function __construct()
    {
        /* Get config variables */
        $client_id = Config::get('google.client_id');
        $service_account_name = Config::get('google.service_account_name');
        $key_file_location = base_path() . Config::get('google.key_file_location');

        $this->client = new \Google_Client();
        $this->client->setApplicationName("Your Application Name");
        $this->service = new \Google_Service_Calendar($this->client);

        /* If we have an access token */
        if (Cache::has('service_token')) {
            $this->client->setAccessToken(Cache::get('service_token'));
        }

        $key = file_get_contents($key_file_location);
        /* Add the scopes you need */
        $scopes = array('https://www.googleapis.com/auth/drive');
        $cred = new \Google_Auth_AssertionCredentials(
            $service_account_name,
            $scopes,
            $key
        );

        $this->client->setAssertionCredentials($cred);
        if ($this->client->getAuth()->isAccessTokenExpired()) {
            $this->client->getAuth()->refreshTokenWithAssertion($cred);
        }
        Cache::forever('service_token', $this->client->getAccessToken());
    }

    public function get($calendarId)
    {

        $results = $this->service->calendars->get($calendarId);
        dd($results);
    }

    public static function test()
    {

//        $client_id = Config::get('google.client_id');
//        $service_account_name = Config::get('google.service_account_name');
//        $key_file_location = base_path() . Config::get('google.key_file_location');

        $client = new \Google_Client();
        $client->setApplicationName("Your Application Name");
        $service = new \Google_Service_Drive($client);


        $client->setClientId('148016452710-659aqgies88of1j4j7h16nhl985rirf7.apps.googleusercontent.com');
        $client->setClientSecret('yXqWJAImv5JagiqvqzwoEJAP');
        $client->setRedirectUri('http://localhost/Laravel/Assessment/public/testGoogle');
        $client->setScopes(array('https://www.googleapis.com/auth/drive.file'));
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        session_start();

//        4/CMqLe8QkoOsmGkf1HXPIWEWH3EhYrzHHu5SpqnXnPmc#
//        if($client->isAccessTokenExpired()) {
//            // Don't think this is required for Analytics API V3
//            //$_googleClient->refreshToken($_analytics->dbRefreshToken($_agencyId));
//            echo 'Access Token Expired'; // Debug
//
//            $client->authenticate();
//            $NewAccessToken = json_decode($client->getAccessToken());
//            $client->refreshToken($NewAccessToken->refresh_token);
//        }

//       if (isset($_GET['code']) || (isset($_SESSION['access_token']) && $_SESSION['access_token'])) {
        if (isset($_GET['code'])) {


            if (isset($_GET['code'])) {

                $client->authenticate($_GET['code']);
                $_SESSION['access_token'] = $client->getAccessToken();
            }
            else

                $client->setAccessToken($_SESSION['access_token']);

            $service = new \Google_Service_Drive($client);

            //Insert a file+
            $file = new \Google_Service_Drive_DriveFile();
            $file->setName(uniqid() . '.pdf');
            $file->setDescription('A test document');
            $file->setMimeType('application/pdf');

            $data = file_get_contents(__DIR__ . '/' . 'my_document.pdf');

            $createdFile = $service->files->create($file, array(
                'data' => $data,
                'mimeType' => 'image/jpeg',
                'uploadType' => 'multipart'
            ));

            print_r($createdFile);

        } else {
            $authUrl = $client->createAuthUrl();
            header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
            exit();
        }
        /* If we have an access token */
//        if (Cache::has('service_token')) {
//            $client->setAccessToken(Cache::get('service_token'));
//        }
//
//        $key = file_get_contents($key_file_location);
//        /* Add the scopes you need */
//        $scopes =   array('https://www.googleapis.com/auth/drive', 'https://www.googleapis.com/auth/drive.apps.readonly');
//
//        $cred = new \Google_Auth_AssertionCredentials(
//            $service_account_name,
//            $scopes,
//            $key
//        );
//
//        $client->setAssertionCredentials($cred);
//        if ($client->getAuth()->isAccessTokenExpired()) {
//            $client->getAuth()->refreshTokenWithAssertion($cred);
//        }
//        Cache::forever('service_token', $client->getAccessToken());
//        $file = new \Google_Service_Drive_DriveFile();
//        $file->setName(uniqid().'.jpg');
//        $file->setName('a.pdf');
//        $file->setDescription('A test document');
//        $file->setMimeType('application/pdf');
//
//        $data = file_get_contents(__DIR__.'/'.'my_document.pdf');
//        $pdfFile=__DIR__.'/'.'my_document.pdf';
//
//        $file = new \Google_Service_Drive_DriveFile();
//        $file->setName( 'Hello world Bkn!' );
//        $file->setMimeType( 'application/pdf' );
//        $file = $service->files->create($file, array('data' => file_get_contents($pdfFile), 'mimeType' => 'application/pdf','uploadType'=>'multipart'));
//
//
//
//        if($file){
//            print_r($file);
//        }
//
//        else{
//            return "bye";
//        }


//$client->setClientId('641452628198-1va9248q8ncrq94qb9hv6so55mktrfdr.apps.googleusercontent.com');
//$client->setClientSecret('TE-Z6jn6hw1az2bDY2T3Y34k');
//$client->setRedirectUri('http://google.com');
//$client->setScopes(array('https://www.googleapis.com/auth/drive'));
//
//$service = new \Google_Service_Drive_DriveFile($client);
//
//$authUrl = $client->createAuthUrl();
//
////Request authorization
//print "Please visit:\n$authUrl\n\n";
//print "Please enter the auth code:\n";
//$authCode = trim(fgets(STDIN));
//
//// Exchange authorization code for access token
//$accessToken = $client->authenticate($authCode);
//$client->setAccessToken($accessToken);
//
////Insert a file
//$file = new \Google_DriveFile();
//$localfile = 'a.jpg';
//$title = basename($localfile);
//$file->setTitle($title);
//$file->setDescription('My File');
//$file->setMimeType('image/jpeg');
//
//$data = file_get_contents($localfile);
//
//$createdFile = $service->files->insert($file, array(
//    'data' => $data,
//    'mimeType' => 'image/jpeg',
//));
//
//print_r($createdFile);


//        $optParams = array(
//            'pageSize' => 20,
//            'fields' => "nextPageToken, files(id, name)"
//        );
//        $results = $service->files->listFiles($optParams);
//
//        if (count($results->getFiles()) == 0) {
//            print "No files found.\n";
//        } else {
//            print "Files:\n";
//            foreach ($results->getFiles() as $file) {
//                print_r($file);
//                printf("%s (%s)\n", $file->getName(), $file->getId());
//            }
//        }


//        $fileId = '0B7KTz_S1eBxGLUFqeG1UYnRFRWs';
//        $content = $service->files->export($fileId, 'application/pdf', array(
//            'alt' => 'media' ));
//       var_dump($content);
//        if ($client->getAccessToken()) {
//            // This is uploading a file directly, with no metadata associated.
//            $file = new \Google_Service_Drive_DriveFile();
//            $result = $service->files->create(
//                $file,
//                array(
//                    'data' => file_get_contents(TESTFILE),
//                    'mimeType' => 'application/octet-stream',
//                    'uploadType' => 'media'
//                )
//            );
//
//            // Now lets try and send the metadata as well using multipart!
//            $file = new \Google_Service_Drive_DriveFile();
//            $file->setTitle("Hello World!");
//            $result2 = $service->files->create(
//                $file,
//                array(
//                    'data' => file_get_contents(TESTFILE),
//                    'mimeType' => 'application/octet-stream',
//                    'uploadType' => 'multipart'
//                )
//            );
//        }


    }


}