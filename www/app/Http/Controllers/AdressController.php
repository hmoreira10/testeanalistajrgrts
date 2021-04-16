<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdressRequest;
use App\Repositories\AdressRepository;
use Illuminate\Http\Request;

class AdressController extends Controller
{
    protected $adress;

    public function __construct(AdressRepository $adress)
    {
        $this->adress = $adress;
    }

    public function store(AdressRequest $request, $id)
    {
        $this->adress->store($request, $id);
        return response()->json(201);
    }

    public function update(AdressRequest $request, $id)
    {
        $this->adress->update($request, $id);
        return response()->json(201);
    }

    public function show($id)
    {
        return $this->adress->show($id);
    }

    public function destroy($id)
    {
        $this->adress->destroy($id);
        return redirect()->route('home');
    }
}
