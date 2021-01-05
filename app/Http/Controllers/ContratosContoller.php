<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\Datatables\Datatables;
use App\Forms\ContratoForm;
use App\Contratos;
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
        $data['dataEmissao'] = Carbon::createFromFormat('d/m/Y', $data['dataEmissao'])->format('Y-m-d');
        $data['ativo'] = $data['ativo'] == null? 0 : $data['ativo'];
        
        Contratos::create($data);

        
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
        $model = Contratos::with('Cliente');
        return $DataTables->eloquent($model)
        ->editColumn('dataInicio', function (Contratos $contrato){
            return Carbon::parse($contrato->dataInicio)->format("d/m/Y");
        })
        ->editColumn('dataFinal', function(Contratos $contrato){
            return Carbon::parse($contrato->dataFinal)->format("d/m/Y");
        })
        ->addColumn('cliente', function(Contratos $contrato){
            return $contrato->cliente->razaosocial;
        })
        ->addColumn('action', function(Contratos $contrato){
            return "<a href='contratos-locacao/{$contrato->id}' 
            class='btn btn-primary'><i class='fa fa-fw fa-edit'></i>Editar</a>";
        })
        ->rawColumns(['action'])
        ->toJson();
    }
}
