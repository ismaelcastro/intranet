<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actionPlan extends Model
{
    protected $table = 'actionplans';
    public $timestamps = false;
    protected $fillable = ['label', 'openingDate', 'typeAction', 'source', 'status'];
}
