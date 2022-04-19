<?php

abstract class Test {

	protected $client;

	protected static $listBankAccount;

	function __construct($cli) {
		$this->client = $cli;
	}

	abstract public function runTestSuite();
}