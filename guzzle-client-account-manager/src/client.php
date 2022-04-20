#!/usr/bin/env php

<?php

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/ClientAccountManager.php';
require __DIR__ . '/VerbGetTest.php';
require __DIR__ . '/VerbPostTest.php';
require __DIR__ . '/VerbDeleteTest.php';

$client = new ClientAccountManager();


$suiteGet = new VerbGetTest($client);
$suitePost = new VerbPostTest($client);
$suiteDelete = new VerbDeleteTest($client);

//$suitePost->runTestSuite();
$suiteGet->runTestSuite();
$suiteDelete->runTestSuite();

?>
