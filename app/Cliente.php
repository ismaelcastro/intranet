<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'id',
        'cgc',
        'razaosocial',
        'nmEntCli',
        'telefone',
        'emailSPED',
        'tpPessoa',
        'tpEntCli'
    ];
    public $timestamps = false;

    public function contratos(){
        return $this->hasMany(Contratos::class);
    }
}
