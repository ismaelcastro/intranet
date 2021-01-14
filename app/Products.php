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
        'id_branch'
    ];
    public $timestamps = false;
}
