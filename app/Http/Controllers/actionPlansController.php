<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\actionPlan;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Forms\ActionPlanForm;
use Illuminate\Routing\Controller as BaseController;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;


class actionPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
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
    public function store(FormBuilder $FormBuilder, Request $request)
    {
        $form = $FormBuilder->create(ActionPlanForm::class);

        if(!$form->isValid()){
            return redirect()
                    ->back()
                    ->withErrors( $form->getErrors() )
                    ->withInput();
        };

        $data = $form->getFieldValues();
        $data['openingDate'] = Carbon::toDay();
        $data['status'] = 1;
        actionPlan::create($data); 
        return redirect()->back();       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function datatables(){
        return Datatables::of(actionPlan::query())
            ->editColumn('label', function(actionPlan $actionPlan){
                $link = route('actions.show', ['id' => $actionPlan->id]);
                return "<a href='{$link}'>{$actionPlan->label}</a>";
            })
            ->editColumn('openingDate', function(actionPlan $actionPlan){
               return Carbon::parse($actionPlan->openingDate)->format('d/m/Y');
            })
            ->editColumn('status', function(actionPlan $actionPlan){
                if($actionPlan->status == "Aberto"){
                    return "<span class='label label-success'>{$actionPlan->status}</span>";
                }else{
                    return "<span class='label label-danger'>{$actionPlan->status}</span>";   
                }
                
            })
            ->rawColumns(['label', 'status'])
            ->toJson();
    }
}
