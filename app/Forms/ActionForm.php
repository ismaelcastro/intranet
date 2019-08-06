<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ActionForm extends Form
{
    public function buildForm()
    {
        $this
        ->add('label', 'text', [
        	'label' => 'Descrição',
        	'rules' => 'required',
        ])
        ->add('actionplans_id', 'hidden',[
        	'rules' => 'required',
        ])
        ->add('DTprevEnd', 'date', [
        	'label' => 'Data prevista para conclusão',
        	'rules' => 'required',
        ])
        ->add('submit', 'submit',[
            'label' => 'Salvar',
            'attr' => [
                'class' => 'btn btn-info pull-rigth'
            ]
        ]);
        

    }
}
