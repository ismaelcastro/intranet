<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratos extends Model
{
    protected $fillable = [
        'numeroContrato', 
        'descricao', 
        'dtFaturamento', 
        'dataEmissao', 
        'dataInicio',
        'dataFinal',
        'valor',
        'ativo',
        'id_planoVenda',
        'id_cliente'
    ];
    public $timestamps = false;

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function planovenda(){
        return $this->belongsTo(PlanoVenda::class);
    }


}
