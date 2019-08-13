<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qualityaction;
use App\Events;
use App\actionPlan;
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
        qualityaction::create($data);
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
        if($PAname = actionPlan::findOrFail($id)->label){
            $form = $FormBuilder->create(ActionForm::class, [
                'method' => 'post',
                'url'    => route('actions.store')
            ]);

            $form->modify('actionplans_id', 'hidden',[
                'value' => $id,
            ]);

            return view('actionplans.index', compact('id', 'form', 'PAname'));
        };
        return abort(404);

        
        
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
    public function update(Request $request, $id, Events $Events)
    {

        
        if( isset($request->action) && $request->action == 'encerrar' ){
            $QA = qualityaction::find($id);
            $QA->DTend = Carbon::today();
            $QA->effective= 1;
            $QA->save();

        }elseif(isset($request->action) && $request->action == 'duplicate'){
            $QA = qualityaction::find($id);
            $data = array(
               'label' => $QA->label . "-" . Carbon::today()->format('d-m-Y'),
               'actionplans_id' => $QA->actionplans_id,
               'DTprevEnd' => Carbon::today()->add(15, 'days')->format('Y-m-d'),
               'DTverify' => Carbon::today()->add(60, 'days')->format('Y-m-d'),
               'duplicate' => 0,
            );

            $newQA = qualityaction::create($data);
            // Events create
            $eventData = array();
            $eventData['dateStart'] = $data['DTverify'];
            $eventData['title'] = "Verificação da ação " . $data['label'];
            $Events->createReminder($eventData);
            // end Evend create
             
            $QA->effective = 0;
            $QA->DTend = Carbon::today();
            $QA->beforeaction = $newQA->id;
            $QA->duplicate = 1;
            $QA->save();

        }
        return redirect()->back();
        
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
                if($QA->effective === null){
                    return "<small class='label bg-yellow'>Em avaliação !</small>";
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
            ->editColumn('created_at', function(qualityaction $QA){
                return Carbon::parse($QA->created_at)->format('d/m/Y');
            })
            ->addColumn('action', function(qualityaction $QA){
                if($QA->DTend === NULL){
                return "<form method='POST' style='display:inline' action='$QA->id'>
                    <input type='hidden' name='_method' value='PUT'>
                    
                    ".
                    csrf_field()."
                    <button class='btn btn-success' name='action' value='encerrar'>Encerrar/Eficaz</button>
                    <button class='btn btn-default' name='action' value='duplicate'>Não eficaz
                    </button>
                                            
                    </form>";
                }else{
                    return "<form method='POST' style='display:inline' action='$QA->id'>
                    <input type='hidden' name='_method' value='PUT'>
                    
                    ".
                    csrf_field()."
                    <button class='btn btn-success' name='action' disabled >Encerrar/Eficaz</button>
                    
                    <button class='btn btn-default' name='action' disabled >Não eficaz</button>                        
                    </form>";


                };
            })           
            ->rawColumns(['deadline', 'effective', 'duplicate', 'DTend', 'action'])
            ->toJson();
    }
}

