<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;
use App\Contracts;
use App\Branch;
use App\Products;

class AddProdToContract extends Form
{
    public function buildForm()
    {
        $this
        ->add('id_contract', 'select', [
            'label' => 'Contrato',
            'choices' => Contracts::select(DB::raw("CONCAT(numberContract,' - ', description) AS Contract"), 'id')
            ->pluck('Contract', 'id')->toArray(),
            'attr' => [
                'class' => 'form-control select2'
            ],
            'empty_value' => '>> Selecine um Contrato <<'
        ])
        ->add('id_product', 'select', [
            'label' => 'Acessório de ',
            'choices' => Products::select(DB::raw("CONCAT(nome, ' - ', numSerie) AS nome"), 'id')
                                        ->where('tpobj','=' ,'Equipamento')
                                        ->pluck('nome', 'id')
                                        ->toArray(),
            'attr' => [
                'class' => 'form-control select2'
            ],
            'empty_value' => '>> Selecine <<'
        ])
        ->add('id_branch', 'select', [
            'label' => 'Filial',
            'rules' => 'required',
            'choices' => Branch::pluck('name', 'id')->toArray(),
            'attr' => [
                'class' => 'form-control select2'
            ]
        ])
        ->add('qtSaldo', 'number',[
            'label' => 'Quantidade',

        ])
        ->add('numSerie', 'text',[
            'label' => 'Nº Serie',
            'rules' => 'required|min:4',
        ])
        ->add('codp', 'text',[
            'rules' => 'required',
            'label' => 'Cod. Interno',
            'attr' => [
                'readonly' => true
            ]
        ])
        ->add('apelido', 'text', [
            'label' => 'Cod. Alternativo',
            'rules' => 'required',
            'attr' => [
                'readonly' => true
            ]
        ])
        ->add('nome', 'hidden', [
            'label' => 'Nome do Produto',
            'rules' => 'required',
            'attr' => [
                'id' =>'nome',
                'readonly' => true
            ]
        ])
        ->add('dsUnidade', 'text', [
            'rules' => 'required',
            'label' => 'Unidade',
            'attr' => [
                'readonly' => true
            ]
        ])
        ->add('qtd', 'number',[
            'label' => 'QTD',
            'rules' => 'required',
            'value' => 1
        ])
        ->add('valor', 'number', [
            'label' => 'Valor do Item',
            'rules' => 'required|numeric',

        ])
        ->add('dsLocal', 'text',[
            'label' => 'Local de Estoque',
            'rules' => 'required',
            'attr' => [
                'readonly' => true
            ]
        ])
        ->add('Tipo', 'text', [
            'label' => 'Tipo de Mercadoria',
            'rules' => 'required',
            'attr' => [
                'readonly' => true
            ]

        ])
        ->add('fvenda','hidden', [
            'rules' => 'required',
            'attr' => [
                'id' => 'fvenda',
                'readonly' => true
            ]
        ])
        ->add('tpobj', 'select',[
            'label' => 'Tipo de Objeto',
            'rules' => 'required',
            'choices' => ['Equipamento' => 'Equipamento', 'Acessorio' => 'Acessorio'],
            'empty_value' => '>> Selecine Tipo de Objeto <<'
        ])
        ->add('submit', 'submit', [
            'label' => 'Adicionar',
            'attr' => ['class' => 'btn btn-primary']
        ]);
    }
}
