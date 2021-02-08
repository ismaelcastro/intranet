<?php

namespace App\Forms;

use App\Products;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\Form;

class AcessoriesForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id_equipamento', 'hidden',[
                'rules' => 'required',
                'label' => 'Equipamento'
            ])
            ->add('id_contract', 'hidden', [
                'rules' => 'required'
            ])
            ->add('id_acessorio', 'select',[
                'label' => 'Acessórios Disponíveis',
                'choices' => Products::select(DB::raw("CONCAT(numSerie, ' - ', nome) AS nome"), 'id')
                ->where('id_contract','=' , NULL)
                ->where('active', '=', 1)
                ->where('tpobj', '=', 'Acessorio' )
                ->pluck('nome', 'id')->toArray(),
                'attr' => [
                    'class' => 'form-control select2'
                ]
            ])
            ->add('submit', 'submit', [
                'label' => 'Adicionar',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }
}
