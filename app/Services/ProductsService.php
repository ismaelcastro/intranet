<?php
namespace App\Services;

use App\SummaryObj;
use App\Products;
use App\LocMov;

class ProductsService{
    private function createLocMov($product_id, $contract_id, $tp){
        $teste = LocMov::create([
            'contract_id' => $contract_id,
            'product_id' => $product_id,
            'tp' => $tp,
        ]);
    }
    public function createLocMovReturn($product_id, $contract_id){
        $this->createLocMov($product_id, $contract_id, 'R');

    }

    public function createLocMovInput($product_id, $contract_id){
        $this->createLocMov($product_id, $contract_id, 'E');
    }
    public function createLocMovOut($product_id, $contract_id){
        $this->createLocMov($product_id, $contract_id, 'S');
    }
}
