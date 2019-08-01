<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $events = array();


        $evt_query = Events::all();

        foreach ($evt_query as $evt) {
            
            array_push($events,
                array(
                    'id'    => $evt->id,
                    'title' => $evt->title,
                    'start' => $evt->dateStart,
                    'end'   => $evt->dateEnd,
                    'backgroundColor' => $evt->color,
                    'borderColor' => $evt->color,
                    'recurrence'    => $evt->recurrence,
                )
            );
            
        }

        if($request->type == 'Ferias'){
             $events_arr = array(
                array(
                    'title' => 'Férias Ismael Castro',
                    'start' => '2019-07-30',
                    'end'   => '2019-08-05',
                    'backgroundColor' => '#f39c12',
                    'borderColor'   => '#f39c12',
                ),
                array(
                    'title' => 'Férias Funcionario teste',
                    'start' => '2019-07-30',
                    'end'   => '2019-08-05',
                    'backgroundColor' => '#3c8dbc',
                    'borderColor'   => '#3c8dbc',
                    'allDay'=> true,
                )
            );
        }else{
            $events_arr = array(
                array(
                    'title' => 'Lembrete',
                    'start' => '2019-07-30',
                    'end'   => '2019-08-05',
                    'backgroundColor' => '#f39c12',
                    'borderColor'   => '#f39c12',
                )               
            );

        }


        return json_encode($events_arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function eventAJAX(){


        
        
    }
}
