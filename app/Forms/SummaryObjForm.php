<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SummaryObjForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('product_id', 'select')
            ->add('summary', 'textarea')
            ->add('submit', 'submit');
    }
}
