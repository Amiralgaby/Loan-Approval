<?php

require_once __DIR__ . '/Test.php';

use Assert\Assertion;
use GuzzleHttp\Exception\ClientException;

class VerbGetTest extends Test {

	public function __construct($cli) {
		parent::__construct($cli);
	}

	public function runTestSuite() {
		$this->testGetAll();
		$this->testGetValidId();
		$this->testGetInvalidId();
	}

	/* Get /acc */
	public function testGetAll() {

		echo "testGetAll started...\n";

		$res = $this->client->getAll();

		Assertion::eq($res->getStatusCode(),200);

		self::$listBankAccount = json_decode($res->getBody(),true);

		echo "testGetAll Ok\n";
	}

	/* Get /acc/{id} */
	public function testGetValidId() {

		echo "testGetValidId started...\n";

		$validUUID = self::$listBankAccount[0]["uuid"];

		$res = $this->client->getById($validUUID);

		Assertion::eq($res->getStatusCode(),200);

		$jsonResponse = json_decode($res->getBody(),true);

		Assertion::eq($jsonResponse,self::$listBankAccount[0]);

		echo "testGetValidId Ok\n";
	}

	/* Get /acc/{id} */
	public function testGetInvalidId()
	{
		echo "testGetInvalidId started...\n";

		try {
			$res = $this->client->getById('anomalie123456789');
		} catch (ClientException $clientException) {
			Assertion::eq(404,$clientException->getResponse()->getStatusCode());
		}

		echo "testGetInvalidId Ok\n";
	}
}