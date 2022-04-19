<?php

require __DIR__ . '/ClientApi.php';

use GuzzleHttp\Client;

class ClientAccountManager extends ClientApi {

	private $route = 'acc';

	function __construct() {
		parent::__construct();
	}

	public function getAll() {
		return $this->request('GET', $this->route);
	}

	public function getById($id) {
		return $this->request('GET', $this->route . '/' . $id);
	}

	public function postBankAccount($nom,$prenom,$account,$risk) {
		return $this->request('POST', $this->route, 
			[ 'json' => 
				[
					"nom" => $nom,
					"prenom" => $prenom,
					"account" => $account,
					"risk" => $risk,
				]
			] 
		);
	}
}