<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    public function createReminder($data){

    	$data['type'] = 'lembrete';
        
        $data['active'] = 1;
        $data['color'] = "#D32F2F";
        
    }
}
