<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'codp',
        'apelido',
        'nome',
        'dsUnidade',
        'qtd',
        'qtSaldo',
        'valor',
        'fvenda',
        'dsLocal',
        'Tipo',
        'cdLote',
        'numSerie',
        'id_contract',
        'id_branch',
        'id_product',
        'tpobj'
    ];
    public $timestamps = false;

    public function contracts(){
        return $this->belongsTo(Contracts::class, 'id_contract');
    }
    public function objLinked(){
        return $this->hasMany(Products::class, 'id_product');
    }
    public function movs(){
        return $this->hasMany(LocMov::class, 'product_id');
    }
}
