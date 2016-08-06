<?php
require('../vendor/autoload.php');

use Infogram\InfogramRequest;
use Infogram\RequestSigningSession;
$base_url="";

/*$consumerKey = 'VUApwa4TmNgRdpSRcwIDvPjecM9HERpj';
$consumerSecret = 'E7yzeqvntsV9J6SPgf12paxa0zGwypDs';*/
$consumerKey = 'XdqqDYRZ2IZgfhxVMR8KshgCFHaf4hDT';
$consumerSecret = 'xh7L4gQ8wCM5if9ZyVTQYD5WGgLex0hn';
$session = new RequestSigningSession($consumerKey, $consumerSecret);
/*$baseUrl = $base_url;

$content = array(
    array(
        'type' => 'h1',
        'text' => 'Testing PHP API client'
    ),
    array(
        'type' => 'body',
        'text'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu porttitor sapien. Donec hendrerit, mi id ultricies varius, sem ex venenatis erat, id posuere nunc quam quis metus'
    ),
    array(
        'type' => 'quote',
        'text' => 'God does not play dice',
        'author' => 'Альберт Эйнштейн'
    ),
    array(
        'type' => 'chart',
        'chart_type' => 'pie',
        'data' => array(
            array(
                array('apples', 'today', 'yesterday', 'd. bef. yesterday'),
                array('John', 4, 6, 7),
                array('Peter', 1, 3, 9),
                array('George', 4, 4, 3)
            )
        )
    )
);
$session = new RequestSigningSession($consumerKey, $consumerSecret);
$request = new InfogramRequest($session, 'POST', 'infographics/', array('content' => $content, 'theme_id' => 299), $baseUrl);
$response = $request->execute();
if (! $response) {
    die("Could not connect to the server\n");
}
if (!$response->isOK()) {
    die('Could not execute request: ' . $response->getBody() . "\n");
}
$id = $response->getHeader('X-Infogram-Id');
die('Infographic created, id: ' . $id . "\n");*/
$baseUrl="https://infogr.am/service/v1/";
$content = array(
    array(
        'type' => 'h1',
        'text' => 'Testing PHP API client'
    ),
    array(
        'type' => 'body',
        'text'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu porttitor sapien. Donec hendrerit, mi id ultricies varius, sem ex venenatis erat, id posuere nunc quam quis metus'
    ),
    array(
        'type' => 'quote',
        'text' => 'God does not play dice',
        'author' => 'Альберт Эйнштейн'
    ),
    array(
        'type' => 'chart',
        'chart_type' => 'pie-irregular',
        'data' => array(
            array(
                array('apples', 'today', 'yesterday', 'd. bef. yesterday'),
                array('John', 4, 6, 7),
                array('Peter', 1, 3, 9),
                array('George', 4, 4, 3)
            )
        )
    )
);
$session = new RequestSigningSession($consumerKey, $consumerSecret);
$request = new InfogramRequest($session, 'POST', 'infographics/', array('content' => $content, 'theme_id' => 299), $baseUrl);
$response = $request->execute();
if (! $response) {
    die("Could not connect to the server\n");
}
if (!$response->isOK()) {
    die('Could not execute request: ' . $response->getBody() . "\n");
}
$result = $response->getBody();
$image=$result->thumbnail_url;
echo $image;