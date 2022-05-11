#!/usr/bin/env php

<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../account-manager-suite-test/ClientAccountManager.php';

use GuzzleHttp\Client;
use Assert\Assertion;
use GuzzleHttp\Exception\ClientException;


// DEFINITION DES VARIABLES
$baseUriLoanApproval = 'https://pacific-beach-06731.herokuapp.com/';
$routeApi = 'test';

$client = new Client(['base_uri' => $baseUriLoanApproval]);


// RECUPERATION DES COMPTES BANCAIRES DISPONIBLES
$clientAccountManager = new ClientAccountManager();
$bankAccountDispo = [];
try 
{
	$res = $clientAccountManager->getAll();
	$bankAccountDispo = json_decode($res->getBody(),true);
}
catch (ClientException $clientException)
{
	echo "Error pour récupérer les bankAccount disponibles";
	return;
}


// FONCTION POUR FAIRE L'APPEL À L'API
function getResponseFromLoanApproval($accountNum,$valeur) {
	global $client, $routeApi;
	return $client->get($routeApi . '?accountNum=' . $accountNum . '&valeur=' . $valeur);
}

// test :
//		accountNum : pas valide
// 		valeur : moins du plafond à faible risque (10 000)
echo "test :\n\taccountNum invalide\n\tvaleur < 10 000\n";
try 
{
	$res = getResponseFromLoanApproval(3843948482,100);
	echo "Not excepted : attendu response avec un code de retour 404, à reçu : ".$res->getStatusCode()."\n";
}
catch (ClientException $clientException)
{
	Assertion::eq(404,$clientException->getResponse()->getStatusCode());
	echo "Success : obtain status code 404\n";
}


// test :
// 		accountNum : valide
// 		valeur : moins du plafond
echo "\n\ntest :\n\taccountNum valide\n\tvaleur < 10 000\n";
try
{
	$numCompte = $bankAccountDispo[0]["uuid"];
	$res = getResponseFromLoanApproval($numCompte,1234);
	Assertion::eq(200, $res->getStatusCode());
	echo "Success : obtain status code 200\n";
}
catch (ClientException $clientException)
{
	echo "Not excepted : attendu une réponse 200, reçu ".$clientException->getResponse()->getStatusCode()."\n";
}
?>