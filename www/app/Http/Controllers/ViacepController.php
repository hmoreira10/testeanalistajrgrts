<?php

namespace App\Http\Controllers;

use App\Services\ViacepService;
use Illuminate\Http\Request;

class ViacepController extends Controller
{
    public function getByCep($cep)
    {
        $service = new ViacepService($cep);
        return $service->getLocation();
    }
}
