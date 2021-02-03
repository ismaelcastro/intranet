<?php

namespace App\Forms;

use App\Products;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\Form;

class UpdateObjContract extends Form
{
    public function buildForm()
    {
        $this
            ->add('id_product', 'select',[
                'label' => 'Produto',
                'rules' => 'required',
                'attr' => [
                    'class' => ['form-control select2']
                ],
                'choices' => Products::select(DB::raw("CONCAT(numSerie, ' - ', nome) AS nome"), 'id')
                    ->where('id_contract','=' , NULL)
                    ->pluck('nome', 'id')->toArray(),
                'empty_value' => '>> Tipo de Produto <<'
            ])
            ->add('id_contract', 'hidden', [
                'rules' => 'required'
            ])
            ->add('submit','submit', [
                'attr' => [
                    'class' => ['btn btn-primary']
                ]
            ]);
    }
}
