<?php

namespace App\Http\Controllers;

use App\Forms\SummaryObjForm;
use App\Products;
use App\SummaryObj;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\DB;

class SummaryObjController extends Controller
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
    public function store( FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(SummaryObjForm::class);

        if(!$form->isValid()){
            return redirect()
                    ->back()
                    ->withErrors( $form->getErrors() )
                    ->withInput();
        }

        $data = $form->getFieldValues();

        DB::beginTransaction();
        $createSummary = SummaryObj::create($data);
        $product = Products::find($data['product_id']);
        $product->active = 0;
        $product->id_contract = NULL;
        if(!$createSummary || !$product->save()){
            DB::rollBack();
        }else{
            DB::commit();
        }
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
