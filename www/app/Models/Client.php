<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'cnpj', 'phone', 'responsible', 'email'];

    public function adresses()
    {
        return $this->hasMany('App\Models\Adress');
    }
}
