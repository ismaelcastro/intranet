<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    protected $fillable = [
        'numberContract', 
        'description', 
        'dtbilling', 
        'dtemission', 
        'dtStart',
        'dtEnd',
        'price',
        'manager',
        'active',
        'id_branch',
        'id_type',
        'id_saleplans',
        'id_customers'
    ];
    public $timestamps = false;

    public function customer(){
        return $this->belongsTo(Customers::class, 'id_customers');
    }

    public function salesplan(){
        return $this->belongsTo(Saleplans::class);
    }
}
