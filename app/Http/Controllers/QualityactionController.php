<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qualityaction;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class QualityactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return view('actionplans.index');
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
    public function datatables($id, Datatables $DataTables){
        $model = qualityaction::where('actionplans_id', 1);
        return $DataTables->eloquent($model)            
            ->editColumn('DTend', function(qualityaction $QA){
                if($QA->DTend == null){
                    return "Em aberto";
                }else{
                    return $QA->DTend;
                }
                
            })
            ->addColumn('deadline', function(qualityaction $QA){
                if($QA->DTend == null && $QA->newDTforEnd == null){
                    return "Em aberto";
                }elseif($QA->DTend != null && $QA->newDTforEnd == null){
                    return "<i class='fa fw fa-thumbs-up text-success'></i>";
                }else{
                    return "<i class='fa fw fa-thumbs-down text-danger'></i>";
                };
            })
            ->editColumn('effective', function(qualityaction $QA){
                if($QA->effective == null){
                    return "Não avaliado !";
                }elseif($QA->effective == 0 ){
                    return "<i class='fa fw fa-thumbs-down text-danger'></i>"; 
                }else{
                    return "<i class='fa fw fa-thumbs-up text-success'></i>";
                }
            })
            ->editColumn('duplicate', function(qualityaction $QA){
                if($QA->duplicate == 1){
                    return "<i class='fa fw fa-thumbs-up text-success'></i>";
                }else{
                    return "<i class='fa fw fa-thumbs-down text-danger'></i>"; 
                }
            })
            ->editColumn('beforeaction', function(qualityaction $QA){
                if($QA->beforeaction == null){
                    return '-';
                }else{
                    return $QA->beforeaction;
                }
            })           
            ->rawColumns(['deadline', 'effective', 'duplicate'])
            ->toJson();
    }
}

