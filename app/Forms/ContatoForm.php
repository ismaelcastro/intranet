<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ContatoForm extends Form
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
            ->add('dataEmissao', 'date', [
                'label' => 'Data Emissão',
                'rules' => 'required'
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
            ->add('cliente', 'select', [
                'label' => 'Cliente',
                'rules' => 'required',
                'attr' => [
                    'class' => 'form-control select2',
                ],

            ])
            ->add('prazoRec', 'text')
            ->add('gestor', 'text')
            ->add('Moeda', 'text')
            ->add('Valor', 'text');
    }
}
