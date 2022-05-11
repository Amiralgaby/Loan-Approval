<?php

require_once __DIR__ . '/Test.php';

use Assert\Assertion;
use GuzzleHttp\Exception\ClientException;

class VerbDeleteTest extends Test {

	public function __construct($cli) {
		parent::__construct($cli);
	}

	public function runTestSuite() {
		$this->testDeleteExistantBankAccount();
		$this->testDeleteInexistantBankAccount();
	}

	public function testDeleteExistantBankAccount() {

		echo "testDeleteExistantBankAccount started...\n";

		$bankAccount = self::$listBankAccount[0]["uuid"];
		$res = $this->client->deleteBankAccount($bankAccount);

		Assertion::eq($res->getStatusCode(),204);

		echo "testDeleteExistantBankAccount Ok\n";
	}

	public function testDeleteInexistantBankAccount() {

		echo "testDeleteExistantBankAccount started...\n";

		try {
			$res = $this->client->deleteBankAccount('anomalie');
		} catch(ClientException $clientException) {
			Assertion::eq(404,$clientException->getResponse()->getStatusCode());
		}

		echo "testDeleteInexistantBankAccount Ok...\n";
	}

}
