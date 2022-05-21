#!/usr/bin/env php

<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/account-manager-suite-test/ClientAccountManager.php';

use GuzzleHttp\Client;
use Assert\Assertion;
use GuzzleHttp\Exception\ClientException;

// DEFINITION DES VARIABLES
$client = new ClientAccountManager();

// RECUPERATION DES COMPTES BANCAIRES DISPONIBLES
$bankAccountDispo = [];
try 
{
	$res = $client->getAll();
	$bankAccountDispo = json_decode($res->getBody(),true);
}
catch (ClientException $clientException)
{
	echo "Error pour récupérer les bankAccount disponibles";
	return;
}

// TESTS
// Avec identifiant invalide
$expectedStatusCode=404;
echo "test :\n\tId invalide\n\texpect ".$expectedStatusCode."\n";
try 
{
	$res = $client->checkRisk(38478472737483); // complétement aléatoire, aucune chance que cet id existe
	echo "Not excepted : attendu response avec un code de retour ".$expectedStatusCode.", à reçu : ".$res->getStatusCode()."\n";
}
catch (ClientException $clientException)
{
	Assertion::eq($expectedStatusCode,$clientException->getResponse()->getStatusCode());
	echo "Success : obtain status code ".$expectedStatusCode."\n";
}

// Avec identifiant valide
$expectedStatusCode=200;
echo "\n\ntest :\n\tId existant\n\texpect ".$expectedStatusCode."\n";
try
{
	$numCompte = $bankAccountDispo[0]["uuid"];
	$res = $client->checkRisk($numCompte);
	Assertion::eq($expectedStatusCode, $res->getStatusCode());
	echo "Success : obtain status code ".$expectedStatusCode."\n";
}
catch (ClientException $clientException)
{
	echo "Not excepted : attendu une réponse ".$expectedStatusCode.", reçu ".$clientException->getResponse()->getStatusCode()."\n";
}

// Avec identifiant non numérique
$expectedStatusCode=422;
echo "test :\n\tId non-numérique\n\texpect ".$expectedStatusCode."\n";
try 
{
	$res = $client->checkRisk('string');
	echo "Not excepted : attendu response avec un code de retour ".$expectedStatusCode.", à reçu : ".$res->getStatusCode()."\n";
}
catch (ClientException $clientException)
{
	Assertion::eq($expectedStatusCode,$clientException->getResponse()->getStatusCode());
	echo "Success : obtain status code ".$expectedStatusCode."\n";
}
?>
