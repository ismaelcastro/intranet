<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
	 protected $fillable = ['title', 'type', 'dateStart', 'dateEnd', 'allDay', 'active', 'color', 'recurrence'];

    public function createReminder($data){

    	$data['type'] = 'lembrete';
        
        $data['active'] = 1;
        $data['color'] = "#D32F2F";
        self::create($data);
        return;
        
    }
}
