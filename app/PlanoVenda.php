<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanoVenda extends Model
{
    protected $table = 'planovendas';
    public function contratos(){
        return $this->hasMany(Contratos::class);
    }
}
