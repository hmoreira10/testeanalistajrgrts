<?php

namespace App\Services;


class ViacepService
{

    private string $cep;

    public function __construct($cep)
    {
        $this->cep = $cep;
    }

    public function getLocation()
    {
        $http = new \GuzzleHttp\Client();
        $response = $http->get("http://viacep.com.br/ws/" . $this->cep . "/json");
        return $response->getBody();
    }
}
