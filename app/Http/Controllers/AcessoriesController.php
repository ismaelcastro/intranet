<?php

namespace App\Http\Controllers;

use App\Forms\AcessoriesForm;
use App\Products;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class AcessoriesController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, FormBuilder $formBuilder)
    {
        $p = Products::findOrFail($id);
        $acessories = $p->objLinked;

        $form = $formBuilder->create(AcessoriesForm::class,[
            'method' => 'PUT',
            'url' => route('acessorios.update', $id)
        ]);
        $form->modify('id_equipamento', 'hidden', [
            'value' => $p->id
        ]);
        $form->modify('id_contract', 'hidden', [
            'value' => $p->id_contract,
        ]);
        return view('locacao.acessories.index', compact('acessories', 'p', 'form'));
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
        $acessories = Products::findOrFail($request->id_acessorio);

        $acessories->update([

            'id_product' => $id,
            'id_contract' => $request->id_contract
        ]);

        $acessories->save();
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
