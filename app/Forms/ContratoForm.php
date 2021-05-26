<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;
use App\Customers;
use App\Saleplans;
use App\contractsType;
use App\Branch;
use Carbon\Carbon;

class ContratoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('numberContract', 'text',[
                'label' => 'Nº Contrato',
                'rules' => 'required'
            ])
            ->add('description', 'textarea',[
                'label' => 'Descrição',
                'rules' => 'required',
                'attr' => ['rows' => '2']
            ])
            ->add('id_branch', 'select', [
                'label' => 'Filial',
                'rules' => 'required',
                'choices' => Branch::pluck('name','id')->toArray(),
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'empty_value' => '>> Selecione uma Filial <<'
            ])
            ->add('dtemission', 'text', [
                'label' => 'Data Emissão',
                'rules' => 'required',
                'value' => Carbon::toDay()->format('d/m/Y'),

            ])
            ->add('dtStart', 'date', [
                'label' => 'Data Inicio',
                'rules' => 'required'
            ])
            ->add('dtEnd', 'date', [
                'label' => 'Data Final',
                'rules' => 'required'
            ])
            ->add('dtbilling', 'date', [
                'label' => 'Data Faturamento',
                'rules' => 'required'
            ])
            ->add('id_type', 'select', [
                'label' => 'Tipo de Contrato',
                'rules' => ['required'],
                'choices' => contractsType::pluck('desc','id')->toArray(),
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'empty_value' => '>> Tipo de Contrato <<'
            ])
            ->add('active', 'checkbox',[
                'label' => 'Ativo'
            ])
            ->add('id_customers', 'select', [
                'label' => 'Cliente',
                'rules' => 'required',
                'choices' => Customers::select(DB::raw("CONCAT(id,' - ',CONCAT(CGC,' - ',name)) AS Cliente"), 'id')
                    ->pluck('Cliente', 'id')->toArray(),
                'attr' => [
                    'class' => 'form-control select2',
                ],

            ])
            ->add('id_saleplans', 'select', [
                'label' => 'Prazo de Recebimento',
                'choices' => Saleplans::pluck('dsPlans', 'id')->toArray(),
                'attr' => [
                    'class' => 'form-control select2'
                ]
            ])
            ->add('manager', 'text', [
                'label' => 'Gestor do Contrato'
            ])
            //->add('moeda', 'text')
            ->add('price', 'text',[
                'label' => 'Valor do Contrato'
            ])
            ->add('submit', 'submit', [
                'label' => 'Salvar',
                'attr' => ['class' => 'btn btn-primary']
            ]);


    }
}
