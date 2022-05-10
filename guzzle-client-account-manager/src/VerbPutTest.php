<?php

require_once __DIR__ . '/Test.php';

use Assert\Assertion;
use GuzzleHttp\Exception\ClientException;

class VerbPutTest extends Test {

	public function __construct($cli) {
		parent::__construct($cli);
	}

	public function runTestSuite() {
		$this->testUpdateInexistantBankAccount();
		$this->testUpdateExistantBankAccountWithoutMistake();
		$this->testUpdateExistantBankAccountWithMistake();
	}

	public function testUpdateInexistantBankAccount() {

		echo "testUpdateInexistantBankAccount started...\n";

		try 
		{
			$res = $this->client->updateBankAccount(5558884,"string","string",0.0,0);
			echo "testUpdateInexistantBankAccount Not Ok : status ".$res->getStatusCode().", 404 excepted";
		}
		catch(ClientException $clientException)
		{
			Assertion::eq(404,$clientException->getResponse()->getStatusCode());
			echo "testUpdateInexistantBankAccount Ok\n";
		}
	}

	public function testUpdateExistantBankAccountWithoutMistake() {

		echo "testUpdateExistantBankAccountWithoutMistake started...\n";

		$accountAdded = 3234;

		$bankAccount = self::$listBankAccount[0];
		$res = $this->client->updateBankAccount($bankAccount["uuid"], 
												$bankAccount["nom"], 
												$bankAccount["prenom"], 
												$bankAccount["account"]+$accountAdded,
												$bankAccount["risk"]);

		Assertion::eq($res->getStatusCode(),200);

		$res = $this->client->getById($bankAccount["uuid"]);

		Assertion::eq($res->getStatusCode(), 200);

		$receivedAccount = json_decode($res->getBody(),true);
		Assertion::eq($receivedAccount["account"], $bankAccount["account"]+$accountAdded);

		echo "testUpdateExistantBankAccountWithoutMistake Ok\n";
	}

	public function testUpdateExistantBankAccountWithMistake() {

		echo "testUpdateExistantBankAccountWithMistake started...\n";

		try
		{
			$bankAccount = self::$listBankAccount[0];

			$res = $this->client->updateBankAccount($bankAccount["uuid"],
													"mon nom",
													"prenom",
													"account en string",
													0);

			echo "testUpdateExistantBankAccountWithMistake Not Ok : status code ".$res->getStatusCode().", excepted 400";
		}
		catch(ClientException $clientException)
		{
			Assertion::eq(400,$clientException->getResponse()->getStatusCode());
			echo "testUpdateExistantBankAccountWithMistake Ok\n";
		}
	}
}
