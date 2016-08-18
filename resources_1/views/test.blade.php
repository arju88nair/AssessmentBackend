<?php
/**
 * Created by PhpStorm.
 * User: Himeshu
 * Date: 23-05-2016
 * Time: 15:56
 */
 return "hi";

// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyCwBLJ-V5Ad7n0wh-n5i4QRKtN9d4XGWEs' );
 return $test;
        $array = array();
        foreach ($users as $items) {
            $push = $items['pushNotificationID'];
            array_push($array,$push);
        }
        $registrationIds =$array;

// prep the bundle
$msg =array('message' => 'Hello Rishikesh,your report is ready for download!');

$fields = array
(
    'registration_ids' 	=> $registrationIds,
    'data'			=> $msg
);

$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;
