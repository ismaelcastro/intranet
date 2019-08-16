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
        $events_arr = array();

        $DTstart = $request->start;
        $DTend = $request->end;
        $month = $request->month < 10 ? '0'.$request->month : $request->month;
        $year = $request->year;

        $evt_query = Events::whereRaw("dateStart >= ? or dateEnd <= ? or recurrence IS NOT NULL")->setBindings([$DTstart, $DTend])->get();
        foreach ($evt_query as $evt) {
            list($evtYear,$evtMonth,$evtDay) = explode('-', $evt->dateStart);
            if($evt->recurrence == 'monthly'){
               $dateStart = $year.'-'.$month.'-'.$evtDay;
            }
            else if($evt->recurrence == 'Yearly'){
                $dateStart = $year.'-'.$evtMonth.'-'.$evtDay;
            }else{
                $dateStart = $evt->dateStart;
            }
            array_push($events_arr,
                array(
                    'id'    => $evt->id,
                    'title' => $evt->title,
                    'start' => $dateStart,
                    'end'   => $evt->dateEnd,
                    'backgroundColor' => $evt->color,
                    'borderColor' => $evt->color,
                    'recurrence'    => $evt->recurrence,
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
    public function fiscal(){
         $evt_query = Events::all();   
    }
}
