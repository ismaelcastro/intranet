<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qualityaction extends Model
{
    protected $fillable = ['label', 'actionplans_id', 'DTprevEnd', 'DTverify', 'duplicate'];
    
}
