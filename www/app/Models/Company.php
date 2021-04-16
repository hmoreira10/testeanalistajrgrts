<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'trade_name'];

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }
}
