<?php

namespace App\Repositories;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class ClientRepository
{
    protected $model = Client::class;
    protected $father = Company::class;

    public function __construct()
    {
        $this->model = $this->resolveModel();
        $this->father = $this->resolveFather();
    }
    protected function resolveModel()
    {
        return app($this->model);
    }
    protected function resolveFather()
    {
        return app($this->father);
    }
    public function show($id)
    {
        return new ClientResource($this->model->find($id));
    }
    public function store(Request $request, $id)
    {
        $father = $this->father->find($id);
        $client = new $this->model($request->only(['name', 'cnpj', 'phone', 'responsible', 'email']));
        $father->clients()->save($client);
        return flash('Cliente criado, agora adicione endereços à ele!')->success()->important();
    }

    public function update(Request $request, $id)
    {
        $client = $this->model->find($id);
        $client->update($request->only(['name', 'cnpj', 'phone', 'responsible', 'email']));
        return flash('Cliente Atualizado Com sucesso!')->success()->important();
    }
    public function destroy($id)
    {
        $client = $this->model->find($id);
        $client->delete();
        return flash('Cliente Excluído Com sucesso!')->success()->important();
    }
}
