<?php

use GuzzleHttp\Client;

class ClientApi extends Client{

	// private $baseURI = 'https://resolute-planet-344619.oa.r.appspot.com/';

	function __construct(){
		parent::__construct(
			['base_uri' => 'https://resolute-planet-344619.oa.r.appspot.com/']);
	}
}