<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\Datatables\Datatables;
use App\Forms\ContratoForm;
use App\Contracts;
use App\Products;
use App\contractsType;
use App\Branch;
use App\Forms\ObjLinkedForm;
use App\Forms\SummaryObjForm;
use App\Forms\UpdateObjContract;
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

        return view('locacao.contracts.index', compact('form'));
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
        if(Contracts::create($data)){
            $request->session()->flash('success', 'Contrato criado com sucesso !');

        }else{
            $request->session()->flash('fall', 'Algo deu errado !');
        }
        return redirect()->back();



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, FormBuilder $formBuilder)
    {
        $contracts = Contracts::find($id);
        $products = $contracts->products;
        $form = $formBuilder->create(UpdateObjContract::class,[
            'method' => 'post',
            'url' => 'add-to-contract/product'
        ]);
        $form->modify('id_contract', 'hidden',[
            'value' => $id,
        ]);

        $formSummaryObj = $formBuilder->create(SummaryObjForm::class, [
            'method' => 'POST',
            'url' => route('summaryobj.store'),
        ]);

        return view('locacao.contracts.show', compact('contracts','products', 'form', 'formSummaryObj'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FormBuilder $formBuilder, $id)
    {
        $contract = Contracts::find($id);
        $form = $formBuilder->create(ContratoForm::class, [
            'method' => 'PUT',
            'url' => route('contratos-locacao.update', $id),
        ]);
        $form->modify('numberContract', 'text', [
            'value' => $contract->numberContract,
        ]);
        $form->modify('description', 'textarea', [
            'value' => $contract->description,
        ]);
        $form->modify('dtemission', 'date',[
            'value' => $contract->dtemission,
        ]);
        $form->modify('dtStart', 'date', [
            'value' => $contract->dtStart,
        ]);
        $form->modify('dtEnd', 'date', [
            'value' => $contract->dtEnd,
        ]);
        $form->modify('dtbilling', 'date', [
            'value' => $contract->dtbilling,
        ]);
        $form->modify('id_type', 'select', [

            'selected' => $contract->id_type,
        ]);
        $form->modify('active', 'checkbox', [
            'value' => $contract->active,
            'checked' => $contract->active
        ]);
        $form->modify('id_customers', 'select',[
            'selected' => $contract->id_customers,
        ]);
        $form->modify('manager', 'text', [
            'value' => $contract->manager
        ]);
        $form->modify('id_branch', 'select', [
            'choices' => Branch::pluck('name', 'id')->toArray(),
            'selected' => $contract->id_branch,
            'label' => 'Filial Responsável'
        ]);
        $form->modify('id_saleplans', 'select', [
            'selected' => $contract->id_saleplans,
        ]);
        $form->modify('price', 'text', [
            'value' => $contract->price
        ]);
        $form->modify('submit', 'submit', [
            'label' => 'Atualizar'
        ]);
        return view('locacao.contracts.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FormBuilder $formBuilder )
    {
        $c = Contracts::findOrFail($id);
        $form = $formBuilder->create(ContratoForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        if(!isset($data['active'] ) && empty($data['active'])){
            $data['active'] = 0;
        }
        $c->update($data);
        if($c->save()){
            $request->session()->flash('success', 'Dados atualizados com sucesso !');
        }else{
            $request->session()->flash('fall', 'Desculpe. Algo deu errado !');
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
            return "
            <div class='row'>
                <div class='col-md-4 col-sm-4'>
                    <a
                    href='contratos-locacao/{$contrato->id}'
                    class='btn btn-sm btn-primary'>
                        <i class='fa fa-fw fa-cubes'></i>
                        Objetos Cobertos
                    </a>
                </div>
            </div>
            <div class='row mt-2'>
                <div class='col-md-4 col-sm-4'>
                    <a
                    href='contratos-locacao/{$contrato->id}/edit'
                    class ='btn btn-sm btn-success'>
                        <i class='fa fa-fw fa-edit'></i>
                        Editar
                    </a>
                </div>
            </div>";
        })
        ->editColumn('status', function(Contracts $contrato){
            return $contrato->ativo = 1 ?"<span class='label bg-green'>Ativo</span>" : "<span class='label bg-red'>Inativo</span>";
        })
        ->rawColumns(['action','status'])
        ->toJson();
    }
}
