<?php

namespace App\Repositories;

use App\Http\Resources\AdressResource;
use App\Models\Adress;
use App\Models\Client;
use Illuminate\Http\Request;

class AdressRepository
{
    protected $model = Adress::class;
    protected $father = Client::class;

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
        return new AdressResource($this->model->find($id));
    }
    public function store(Request $request, $id)
    {
        $father = $this->father->find($id);
        $fav = $father->adresses()->where('fav', true)->first();
        if (empty($fav)) {
            $request['fav'] = true;
        } else {
            if ($request->fav == true) {
                $fav->fav = false;
                $fav->save();
            }
        }
        $adress = new $this->model($request->only(['cep', 'patio', 'district', 'complement', 'number', 'city', 'state', 'fav']));
        $father->adresses()->save($adress);
        return flash('Endereço Registrado Com sucesso!')->success()->important();
    }

    public function update(Request $request, $id)
    {
        $adress = $this->model->find($id);
        $father = $adress->client;
        $fav = $father->adresses()->where('fav', true)->first();
        if (empty($fav)) {
            $request['fav'] = true;
        } else {
            if ($request->fav == true) {
                $fav->fav = false;
                $fav->save();
            } else if ($fav->id == $adress->id) {
                $request['fav'] = true;
                $adress->update($request->only(['cep', 'patio', 'district', 'complement', 'number', 'city', 'state', 'fav']));
                return flash('Não é possivel retirar o status de pincipal, torne outro endereço principal!')->warning()->important();
            }
        }
        $adress->update($request->only(['cep', 'patio', 'district', 'complement', 'number', 'city', 'state', 'fav']));
        return flash('Endereço Atualizado Com sucesso!')->success()->important();
    }

    public function destroy($id)
    {
        $adress = $this->model->find($id);
        if ($adress->fav == true) {
            return flash('Não é possivel exlcuir um endereço Principal')->error()->important();
        }
        $adress->delete();
        return flash('Endereço excluído Com sucesso!')->success()->important();
    }
}
