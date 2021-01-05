<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\PlanoVenda;
use Carbon\Carbon;

class ContratoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('numeroContrato', 'text',[
                'label' => 'Nº Contrato',
                'rules' => 'required'
            ])
            ->add('descricao', 'textarea',[
                'label' => 'Descrição',
                'rules' => 'required',
                'attr' => ['rows' => '2']
            ])
            ->add('dataEmissao', 'text', [
                'label' => 'Data Emissão',
                'rules' => 'required',              
                'value' => Carbon::toDay()->format('d/m/Y'),
                
            ])
            ->add('dataInicio', 'date', [
                'label' => 'Data Inicio',
                'rules' => 'required'
            ])
            ->add('dataFinal', 'date', [
                'label' => 'Data Final',
                'rules' => 'required'
            ])
            ->add('dataFaturamento', 'date', [
                'label' => 'Data Faturamento',
                'rules' => 'required'
            ])
            ->add('TipoContrato', 'select', [
                'label' => 'Tipo de Contrato',
                'rules' => ['required'],
                'choices' => ['0' => 'Locação de Equipamentos'],
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'empty_value' => '>> Tipo de Contrato <<'
            ])
            ->add('ativo', 'checkbox',[
                'label' => 'Ativo'
            ])
            ->add('id_cliente', 'select', [
                'label' => 'Cliente',
                'rules' => 'required',
                'choices' => Cliente::select(DB::raw("CONCAT(id,' - ',CONCAT(CGC,' - ',razaosocial)) AS Cliente"), 'id')
                    ->pluck('Cliente', 'id')->toArray(),
                'attr' => [
                    'class' => 'form-control select2',
                ],

            ])
            ->add('id_planoVenda', 'select', [
                'label' => 'Prazo de Recebimento',
                'choices' => PlanoVenda::pluck('nmPlano', 'id')->toArray(),
                'attr' => [
                    'class' => 'form-control select2'
                ]
            ])
            ->add('gestor', 'text', [
                'label' => 'Gestor do Contrato'
            ])
            //->add('moeda', 'text')
            ->add('valor', 'text')
            ->add('submit', 'submit', [
                'label' => 'Salvar',
                'attr' => ['class' => 'btn btn-primary']
            ]);

            
    }
}
