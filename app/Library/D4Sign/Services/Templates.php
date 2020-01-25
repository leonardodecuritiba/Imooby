<?php

namespace App\Library\D4Sign\Services;

use App\Library\D4Sign\Client;
use App\Library\D4Sign\Service;

class Templates extends Service
{
	public function find($templateKey = '')
    {
        $data = array("id_template"=> json_encode($templateKey));
        return $this->client->request("/templates", "POST", $data, 200);
    }

}
