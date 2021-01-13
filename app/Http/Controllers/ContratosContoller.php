<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\Datatables\Datatables;
use App\Forms\ContratoForm;
use App\Contracts;
use Carbon\Carbon;

class ContratosContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(ContratoForm::class, [
            'method' => 'POST',
            'url' => route('contratos-locacao.store')
        ]);
        
        return view('locacao.index', compact('form'));
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
    public function store(FormBuilder $formBuilder,Request $request)
    {
        $form  = $formBuilder->create(ContratoForm::class);
        if(!$form->isValid()){
            return redirect()
    				->back()
    				->withErrors( $form->getErrors() )
    				->withInput();

        }
        $data = $form->getFieldValues();
        $data['dtemission'] = Carbon::createFromFormat('d/m/Y', $data['dtemission'])->format('Y-m-d');
        $data['active'] = $data['active'] == null? 0 : $data['active'];
        Contracts::create($data);

        
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
    public function datatables(DataTables $DataTables){
        $model = Contracts::with('Customer');
        return $DataTables->eloquent($model)
        ->editColumn('dtStart', function (Contracts $contrato){
            return Carbon::parse($contrato->dtStart)->format("d/m/Y");
        })
        ->editColumn('dtEnd', function(Contracts $contrato){
            return Carbon::parse($contrato->dtEnd)->format("d/m/Y");
        })
        ->addColumn('customer', function(Contracts $contrato){
            return $contrato->customer->name;
        })
        ->addColumn('action', function(Contracts $contrato){
            return "<a href='contratos-locacao/{$contrato->id}' 
            class='btn btn-primary'><i class='fa fa-fw fa-edit'></i>Editar</a>";
        })
        ->editColumn('status', function(Contracts $contrato){
            return $contrato->ativo = 1 ?"<span class='label bg-green'>Ativo</span>" : "<span class='label bg-red'>Inativo</span>";
        })
        ->rawColumns(['action','status'])
        ->toJson();
    }
}
