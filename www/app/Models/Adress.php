<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $fillable = ['cep', 'patio', 'district', 'complement', 'number', 'city', 'state', 'fav'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
