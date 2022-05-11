#!/usr/bin/env php

<?php

require __DIR__ . '/../../vendor/autoload.php';

require __DIR__ . '/ClientAccountManager.php';
require __DIR__ . '/VerbGetTest.php';
require __DIR__ . '/VerbPostTest.php';
require __DIR__ . '/VerbDeleteTest.php';
require __DIR__ . '/VerbPutTest.php';

$client = new ClientAccountManager();

$suiteGet = new VerbGetTest($client);
$suitePost = new VerbPostTest($client);
$suitePut = new VerbPutTest($client);
$suiteDelete = new VerbDeleteTest($client);

// POST en premier pour créer des accounts comme ça on peut GET par la suite
$suitePost->runTestSuite();
// GET
$suiteGet->runTestSuite();
// UPDATE
$suitePut->runTestSuite();
// DELETE
$suiteDelete->runTestSuite();

?>
