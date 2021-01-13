<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;
use App\Contracts;

class AddProdToContract extends Form
{
    public function buildForm()
    {
        $this
        ->add('contract_id', 'select', [
            'label' => 'Contrato',
            'rules' => 'required',
            'choices' => Contracts::select(DB::raw("CONCAT(numberContract,' - ', description) AS Contract"), 'id')
            ->pluck('Contract', 'id')->toArray(),
            'attr' => [
                'class' => 'form-control select2'
            ]
        ])
        ->add('qtSaldo', 'number',[
            'label' => 'Quantidade',
            'rules' => 'required'
        ])
        ->add('numSerie', 'text',[
            'label' => 'Nº Serie',
            'rules' => 'required',
        ])
        ->add('id_contract', 'hidden',[
            'rules' => 'required'
        ]);
    }
}
