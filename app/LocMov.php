<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocMov extends Model
{
    protected $table ='loc_movs';
    protected $fillable = ['product_id', 'contract_id', 'tp', 'origem', 'destino'];
    public $timestamps = false;

    public function contract(){
        return $this->belongsTo(Contracts::class, 'contract_id');
    }
    public function product(){
        return $this->hasOne(Products::class, 'product_id');
    }
}
