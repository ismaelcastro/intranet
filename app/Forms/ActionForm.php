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
        	'label' => 'Data prevista para conclusão'
        	'rules' => 'required',
        ])
        ->add('DTverify', 'date', [
        	'label' => 'Data da verificação',
        	'rules' => 'required',
        ])
        ->add('effective', 'checkbox', [
        	'label' => 'Efetivo ?'
        	'checked' => false,
        ])
        ->add('duplicate', 'hidden', [
        	'value' = 0,
        ])

    }
}
