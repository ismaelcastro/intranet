<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SummaryObj extends Model
{
    protected $fillable = ['product_id', 'description'];
    public $timestamps = false;
}
