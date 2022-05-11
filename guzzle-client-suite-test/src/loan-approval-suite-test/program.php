#!/usr/bin/env php

<?php

require __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Client;
use Assert\Assertion;
use GuzzleHttp\Exception\ClientException;

# https://pacific-beach-06731.herokuapp.com/test?accountNum=5655374346584064&valeur=15000

$baseUriLoanApproval = 'https://pacific-beach-06731.herokuapp.com/';
$routeApi = 'test';

$client = new Client(['base_uri' => $baseUriLoanApproval]);

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

echo "\n\n";

// test :
// 		accountNum : valide
// 		valeur : moins du plafond
//$res = getResponseFromLoanApproval();

?>