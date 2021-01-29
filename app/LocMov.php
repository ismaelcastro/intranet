<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocMov extends Model
{
    protected $table ='loc_movs';
    protected $fillable = ['product_id', 'contract_id', 'tp'];
    public $timestamps = false;
}
