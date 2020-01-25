<?php
namespace App\Library\D4Sign;

use App\Library\D4Sign\Services\Documents;
use App\Library\D4Sign\Services\Safes;
use App\Library\D4Sign\Services\Templates;

class Client extends ClientBase
{

	public $serviceConfig;
    public $documents;

    public function __construct()
    {
    	
    	$config = config('services.d4sign');
        $this->serviceConfig = $config;
        $this->setUrl($config['url']);
        $this->setAccessToken($config['accessToken']);

        $this->documents 	= new Documents($this);
        $this->safes 		= new Safes($this);
        $this->templates 	= new Templates($this);
    }
}
