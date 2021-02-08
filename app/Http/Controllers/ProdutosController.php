<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use GuzzleHttp\Client;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Products;
use App\Forms\AddProdToContract;
use App\Forms\UpdateObjContract;
use App\LocMov;
use App\Services\CallistoAPIService;
use App\Services\ProductsService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormBuilder $formBuilder, CallistoAPIService $CallistoAPI)
    {
        $data_string = array(
            'cdFilial'=> 0,
            'cdLocal' => "8,16",
            'estoquezero' => "N",
        );
        $produtos = $CallistoAPI->getJson('listaInvetario', 'post', $data_string);

        $form = $formBuilder->create(AddProdToContract::class, [
            'method' => 'POST',
            'url' => route('produtos.store')
        ]);
        $form->modify('id_branch','select',[
            'label' => 'Item propriedade de',
        ]);
        $form->modify('contract_id','select',[
            'label' => 'Adicionar ao contrato'
        ]);

        return view('locacao.products.produtos', compact('produtos','form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder, Request $request, ProductsService $productsService)
    {
        $form  = $formBuilder->create(AddProdToContract::class);
        if(!$form->isValid()){
            return
            redirect()
            ->back()
            ->withErrors($form->getErrors())
            ->withInput();

        };

        $data = $form->getFieldValues();

        DB::beginTransaction();
        try{
            if($p = Products::create($data)){
                $productsService->createLocMovInput($p->id, $data['id_contract'],'-', 'Patrimônio');
                if(isset($data['id_contract']) && !empty($data['id_contract'])){
                    $productsService->createLocMovOut($p->id, $data['id_contract'], 'Patrimônio', 'Cliente');
                }

                $request->session()->flash('success', 'Item adicionado com sucesso !');
            }else{
                $request->session()->flash('fall', 'Ops ! Algo deu errado.');
            };
            DB::commit();
        }catch(QueryException $ex){
            DB::rollBack();
            $request
            ->session()
            ->flash('fall',
            'Ops ! O N° Serie que você está tentando inserir já está
            vinculado a um contrato ou já existem em patrimônio.');
        }

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
        $product = Products::with('movs')->findOrFail($id);

        return view('locacao.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( FormBuilder $formBuilder ,$id)
    {
        $product = Products::findOrFail($id);
        $form = $formBuilder->create(AddProdToContract::class, [
            'method' => 'PUT',
            'url' => route('produtos.update', $id),
        ]);
        $form->modify('id_branch','select',[
            'selected' => $product->id_branch,
        ]);
        $form->modify('codp', 'text', [
            'value' => $product->codp,
        ]);
        $form->modify('apelido', 'text', [
            'value' => $product->apelido,
        ]);
        $form->modify('nome', 'text', [
            'value' => $product->nome,
        ]);
        $form->modify('dsUnidade', 'text', [
            'value' => $product->dsUnidade
        ]);
        $form->modify('valor', 'number', [
            'value' => $product->valor
        ]);
        $form->modify('dsLocal', 'text',[
            'value' => $product->dsLocal,
        ]);
        $form->modify('Tipo', 'text', [
            'value' => $product->Tipo,
        ]);
        $form->modify('id_contract', 'select', [
            'selected' => $product->id_contract,
            'empty_value' => false,
        ]);
        $form->modify('numSerie', 'text', [
            'value' => $product->numSerie,
            'attr' => [
                'readonly' => true
            ]
        ]);
        $form->modify('qtd', 'hidden', [
            'value' => $product->qtd,
        ]);
        $form->modify('dsLocal', 'hidden',[

            'value' => $product->dsLocal,
        ]);
        $form->modify('fvenda', 'hidden', [
            'value' => $product->fvenda,
        ]);
        $form->modify('tpobj', 'select', [
            'selected' => $product->tpobj,
        ]);
        $form->modify('submit', 'submit',[
            'label' => 'Atualizar'
        ]);

        return view('locacao.products.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormBuilder $formBuilder, Request $request, ProductsService $productsService, $id)
    {
        $product = Products::findOrFail($id);
        $form  = $formBuilder->create(AddProdToContract::class);
        if(!$form->isValid()){
            return
            redirect()
            ->back()
            ->withErrors($form->getErrors())
            ->withInput();

        };
        $data = $form->getFieldValues();
        $product->update($data);
        if($product->save()){
            $request->session()->flash('success', 'Dados Atualizados com sucesso !');
        }else{
            $request->session()->flash('fall', 'Ops ! Algo deu errado.');
        };

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
}
