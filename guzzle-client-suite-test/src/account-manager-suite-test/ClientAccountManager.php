<?php

require __DIR__ . '/ClientApi.php';

use GuzzleHttp\Client;

class ClientAccountManager extends ClientApi {

	private $route = 'acc';

	function __construct() {
		parent::__construct();
	}

	public function getAll() {
		return $this->get($this->route);
	}

	public function getById($id) {
		return $this->get($this->route . '/' . $id);
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

	public function deleteBankAccount($id) {
		return $this->delete($this->route . '/' . $id);
	}

	public function updateBankAccount($uuid,$nom,$prenom,$account,$risk) {
		return $this->request('PUT', $this->route . '/' . $uuid,
			[ 'json' => 
				[
					"nom" => $nom,
					"prenom" => $prenom,
					"account" => $account,
					"risk" => $risk,
				]
			]);
	}
	
	public function checkRisk($id) {
        return $this->get('check/'.$id);
	}
}
