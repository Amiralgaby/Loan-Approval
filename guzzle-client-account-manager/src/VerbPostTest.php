<?php

require_once __DIR__ . '/Test.php';

use Assert\Assertion;
use GuzzleHttp\Exception\ClientException;

class VerbPostTest extends Test {

	public function __construct($cli) {
		parent::__construct($cli);
	}

	public function runTestSuite() {
		$this->testValidPost();
		$this->testInvalidPostRisk();
		$this->testInvalidPostNegativeAccount();
	}

	public function testValidPost() {

		echo "testValidPost started...\n";

		$res = $this->client->postBankAccount('un nom', 'un prenom', 38428, 0);

		Assertion::eq($res->getStatusCode(),201);

		echo "testValidPost Ok\n";
	}

	public function testInvalidPostRisk() {

		echo "testInvalidPostRisk started...\n";

		try {
			$res = $this->client->postBankAccount('un nom', 'un prenom', 38428, 42);
			
			throw new Exception('Le test : testInvalidPostRisk n\'aurait pas dû fonctionner, une erreur 400 était attendue');

		} catch (ClientException $clientException) {
			Assertion::eq(400,$clientException->getResponse()->getStatusCode());
			echo "testInvalidPostRisk Ok\n";
		}
	}

	public function testInvalidPostNegativeAccount() {

		echo "testInvalidPostNegativeAccount started...\n";

		try {

			$this->client->postBankAccount('un nom', 'un prenom', -38428, 0);
			
			throw new Exception('Le test : testInvalidPostNegativeAccount n\'aurait pas dû fonctionner, une erreur 400 était attendue');
		} catch (ClientException $clientException) {
			
			Assertion::eq(400,$clientException->getResponse()->getStatusCode());
			
			echo "testInvalidPostNegativeAccount Ok\n";
		}
	}

}
