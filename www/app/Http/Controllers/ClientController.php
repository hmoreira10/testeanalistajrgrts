<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Repositories\ClientRepository;

class ClientController extends Controller
{
    protected $client;
    public function __construct(ClientRepository $client)
    {
        $this->client = $client;
    }

    public function store(ClientRequest $request, $id)
    {
        $this->client->store($request, $id);
        return response()->json(201);
    }

    public function show($id)
    {
        return $this->client->show($id);
    }

    public function update(ClientRequest $request, $id)
    {
        $this->client->update($request, $id);
        return response()->json(201);
    }

    public function destroy($id)
    {
        $this->client->destroy($id);
        return redirect()->route('home');
    }
}
