<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = 
    [
        'id', 
        'cgc', 
        'name', 
        'nickName', 
        'phone', 
        'mailSPED', 
        'typePerson',
        'typecustomer'
    ];
    public $timestamps = false;

    public function contracts (){
        return $this->hasMany(Contracts::class, 'id');
    }
}
