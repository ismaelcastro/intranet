<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qualityaction;
use App\Events;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Forms\ActionForm;
use Illuminate\Routing\Controller as BaseController;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use RealRashid\SweetAlert\Facades\Alert;


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
    public function store(FormBuilder $FormBuilder, Request $request, Events $Events )
    {
        $eventData = array();
        $form = $FormBuilder->create(ActionForm::class);

        if( !$form->isValid() ){
            return redirect()
                    ->back()
                    ->withErrors( $form->getErrors() )
                    ->withInput();

        };
        $data = $form->getFieldValues();
        $data['DTverify'] = Carbon::parse($data['DTprevEnd'])
            ->add(60, 'days')
            ->format('Y-m-d');
        $data['duplicate'] = 0;

        $eventData['dateStart'] = $data['DTverify'];
        $eventData['title'] = "Verificação da ação " . $data['label'];     
        $Events->createReminder($eventData);
        // qualityaction::create($data);
        Alert::success('Success Title', 'Success Message');
        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, FormBuilder $FormBuilder)
    {
        $form = $FormBuilder->create(ActionForm::class, [
            'method' => 'post',
            'url'    => route('actions.store')
        ]);

        $form->modify('actionplans_id', 'hidden',[
            'value' => $id,
        ]);
        return view('actionplans.index', compact('id', 'form'));
        
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
    public function datatables(Request $Request, Datatables $DataTables){
        $model = qualityaction::where('actionplans_id', $Request->id);
        return $DataTables->eloquent($model)
            ->editColumn('DTprevEnd', function(qualityaction $QA){
                return Carbon::parse($QA->DTprevEnd)->format('d/m/Y');
            })            
            ->editColumn('DTend', function(qualityaction $QA){
                if($QA->DTend == null){
                    return "<small class='label bg-aqua'>Em aberto</small>";
                }else{
                    return Carbon::parse($QA->DTend)->format('d/m/Y');
                }
                
            })
            ->addColumn('deadline', function(qualityaction $QA){
                if($QA->DTend == null && $QA->newDTforEnd == null){
                    return "<small class='label bg-aqua'>Em aberto</small>";
                }elseif($QA->DTend != null && $QA->newDTforEnd == null){
                    return "<i class='fa fw fa-thumbs-up text-success'></i>";
                }else{
                    return "<i class='fa fw fa-thumbs-down text-danger'></i>";
                };
            })
            ->editColumn('effective', function(qualityaction $QA){
                if($QA->effective == null){
                    return "<small class='label bg-yellow'>Em processo de avaliação !</small>";
                }elseif($QA->effective == 0 ){
                    return "<i class='fa fw fa-thumbs-down text-danger'></i>"; 
                }else{
                    return "<i class='fa fw fa-thumbs-up text-success'></i>";
                }
            })
            ->editColumn('DTverify', function(qualityaction $QA){
                return Carbon::parse($QA->DTverify)->format('d/m/Y');
            })
            ->editColumn('duplicate', function(qualityaction $QA){
                if($QA->duplicate == 1){
                    return "<small class='label bg-green'>SIM !</small>";
                }else{
                    return "<small class='label bg-red'>NÃO !</small>"; 
                }
            })
            ->editColumn('beforeaction', function(qualityaction $QA){
                if($QA->beforeaction == null){
                    return '-';
                }else{
                    return $QA->beforeaction;
                }
            })
            ->addColumn('action', function(qualityaction $QA){
                return " 
                <form method='POST' style='display:inline' action='{$QA->id}'>
                <input type='hidden' name='_method' value='delete'>".
                csrf_field()
                ."<button class='btn btn-danger'><i class='fa fw fa-trash'></i> Del</button></form>";
            })           
            ->rawColumns(['deadline', 'effective', 'duplicate', 'DTend', 'action'])
            ->toJson();
    }
}

