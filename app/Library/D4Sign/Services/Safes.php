<?php

namespace App\Library\D4Sign\Services;

use App\Library\D4Sign\Client;
use App\Library\D4Sign\Service;

class Safes extends Service
{
	
	public function find($safeKey = '')
    {
        $data = array();
        return $this->client->request("/safes/$safeKey", "GET", $data, 200);
    }

}
