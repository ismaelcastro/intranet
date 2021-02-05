<?php
namespace App\Services;

use App\SummaryObj;
use App\Products;
use App\LocMov;

class ProductsService{
    private function createLocMov($product_id, $contract_id, $tp, $origem, $destino){

        $teste = LocMov::create([
            'contract_id' => $contract_id,
            'product_id' => $product_id,
            'tp' => $tp,
            'origem' => $origem,
            'destino' => $destino,
        ]);

    }
    public function createLocMovReturn($product_id, $contract_id){
        $this->createLocMov($product_id, $contract_id, 'R', 'Cliente', 'Patrimônio');

    }

    public function createLocMovInput($product_id, $contract_id, $origem, $destino){
        $this->createLocMov($product_id, $contract_id, 'E', $origem, $destino);
    }
    public function createLocMovOut($product_id, $contract_id, $origem, $destino){
        $this->createLocMov($product_id, $contract_id, 'S', $origem, $destino);
    }
}
