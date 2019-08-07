<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ActionPlanForm extends Form
{
    public function buildForm()
    {
        $this
        ->add('label', 'text', [
        	'label' => 'Desc.',
        	'rules' => 'required|min:3',
        ])
        ->add('typeAction', 'select', [
        	'label' => 'Tipo de ação',
        	'rules' => 'required',
        	'choices' => ['1' => 'Melhoria', '2' => 'Corretiva'],
        	'attr' => [
        		'class' => 'form-control select2',
        	]
        ])
        ->add('source', 'select', [
            'label' => 'Origem',
            'rules' => 'required',
            'choices' => ['1' => 'Auditoria Interna', '2' => 'Auditoria Externa', '3' => 'Monitoramento de Processo'],
        ])
        ->add('submit', 'submit', [
            'label' => 'Salvar',
            'attr' => [
                'class' => 'btn btn-info pull-rigth',
            ]
        ]);
    }
}
