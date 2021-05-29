<?php

namespace App\Http\Controllers;

use App\Forms\UpdateObjContract;
use Illuminate\Http\Request;
use App\Products;
use App\Services\ProductsService;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

class ProductContractController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeProdOfContract(Request $request, ProductsService $productsService)
    {

        $p = Products::findOrFail($request->product_id);
        DB::beginTransaction();
        $productsService->createLocMovReturn($p->id, $p->id_contract);
        $p->objLinked->each(function(Products $produto){
            $produto->id_product = NULL;
            $produto->save();
        });
        $p->id_contract  = NULL;
        $p->id_product = NULL;
        $p->save();
        DB::commit();
        return redirect()->back();

    }
    public function addProdToContract(Request $request, ProductsService $productsService, FormBuilder $formBuilder){
        $form = $formBuilder->create(UpdateObjContract::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $p = Products::findOrFail($data['id_product']);

        $p->id_contract = $data['id_contract'];
        $p->save();
        $productsService->createLocMovOut($p->id, $data['id_contract'], 'Patrimônio', 'Cliente');
        return redirect()->back();

    }
}
