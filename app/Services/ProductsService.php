<?php
namespace App\Services;

use App\SummaryObj;
use App\Products;
use App\LocMov;

class ProductsService{
    public function createLocMov($product_id, $contract_id, $tpMov = null){
        if(!isset($tpMov)){
            $tpMov = empty($contract_id) ? 'E':'S';
        };

        $teste = LocMov::create([
            'contract_id' => $contract_id,
            'product_id' => $product_id,
            'tp' => $tpMov,
        ]);

    }
}
