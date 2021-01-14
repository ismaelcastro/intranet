<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Products;
use App\Forms\AddProdToContract;
use App\Services\CallistoAPIService;

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
        
        return view('locacao.produtos', compact('produtos','form'));
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
    public function store(FormBuilder $formBuilder, Request $request)
    {
        $form  = $formBuilder->create(AddProdToContract::class);
        if(!$form->isValid()){
            return 
            redirect()
            ->back()
            ->withErrrors($form->getErrors())
            ->withInput();

        };
        
        $data = $form->getFieldValues();
        Products::create($data);

        
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
}
