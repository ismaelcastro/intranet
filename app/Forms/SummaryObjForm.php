<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SummaryObjForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('product_id', 'hidden')
            ->add('description', 'textarea',[
                'label' => 'Diagnóstico',
                'rules' => 'required|min:10'
            ])
            ->add('submit', 'submit', [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'label' => 'Salvar',
            ]);
    }
}
