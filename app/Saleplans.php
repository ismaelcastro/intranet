<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saleplans extends Model
{
    public function contracts(){
       return $this->hasMany(Contracts::class, '');
    }
}
