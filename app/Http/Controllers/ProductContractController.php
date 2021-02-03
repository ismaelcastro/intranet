<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Services\ProductsService;

class ProductContractController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ProductsService $productsService)
    {

        $p = Products::findOrFail($request->product_id);
        $productsService->createLocMovReturn($p->id, $p->id_contract);
        $p->id_contract  = NULL;
        $p->id_product = NULL;

        $p->save();
        return redirect()->back();

    }
}
