#!/usr/bin/env php

<?php

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/ClientAccountManager.php';
require __DIR__ . '/VerbGetTest.php';
require __DIR__ . '/VerbPostTest.php';

/*
use GuzzleHttp\Client;

$baseURI = "https://resolute-planet-344619.oa.r.appspot.com/";
$routeAccount = "acc";

$client = new Client(['base_uri' => $baseURI]);

$response = $client->request('GET', $routeAccount);

# var_dump($response);

echo $response->getStatusCode();

echo "\n";

echo $response->getBody();

echo "\n";
*/

$client = new ClientAccountManager();

// var_dump($client);

$suiteGet = new VerbGetTest($client);
$suitePost = new VerbPostTest($client);

// var_dump($suiteGet);
$suitePost->runTestSuite();
$suiteGet->runTestSuite();



?>
