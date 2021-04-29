<?php

namespace App\Http\Controllers\Rel\Financeiro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use GuzzleHttp\Client;
use function foo\func;
use Carbon\Carbon;

class Financeiro212Controller extends Controller
{
    public function index(Request $request)
    {

        $data_string = array(
            'cdFilial'=> $request->cdFilial,
            'dtInicio' => $request->dtInicio,
            'dtFim' => $request->dtFim,
        );
        $client = new Client(['base_uri' => 'http://api.proel.local/api/', 'verify' => false]);
        $res = $client->request('post', 'Financeiro212',[
            'headers' => [
                'Content-type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode($data_string)
        ]);

        $data = json_decode( $res->getBody()->getContents() );

        return Datatables::of($data)
            ->editColumn('Cliente', function ($data){
                return $data->cdCliente . " - " . $data->nmCliente;
            })
            ->editColumn('dtVencto', function($data){
                return Carbon::parse($data->dtVencto)->format("d/m/Y");
            })
            ->editColumn('dtLancto', function ($data){
                return Carbon::parse($data->dtLancto)->format("d/m/Y");
            })
            ->editColumn('dtEmissao', function($data){
                return Carbon::parse($data->dtEmissao)->format("d/m/Y");
            })
            ->editColumn('dtPag', function($data){
                return Carbon::parse($data->dtPag)->format("d/m/Y");
            })
            ->editColumn('dtBaixa', function($data){
                return Carbon::parse($data->dtBaixa)->format("d/m/Y");
            })
            ->editColumn('vlBruto', function($data){
                return "R$ " . number_format($data->vlBruto, 2,',', '.');
            })
            ->editColumn('EmissaoPedido', function($data){
                return Carbon::parse($data->EmissaoPedido)->format("d/m/Y");
            })
            ->editColumn('vlPago', function($data){
                return "R$ " . number_format($data->vlPago, 2, ',', '.');
            })
            ->editColumn('vlBrutoMov', function($data){
                return "R$ " . number_format($data->vlBrutoMov, 2, ',', '.');
            })
            ->editColumn('vlBaseBruto', function($data){
                return "R$ " . number_format($data->vlBaseBruto, 2, ',', '.');
            })
            ->editColumn('vlLiquidoMov', function($data){
                return "R$ " . number_format($data->vlLiquidoMov, 2, ',', '.');
            })
            ->editColumn('vlFinanceiroMov', function($data){
                return "R$ " . number_format($data->vlFinanceiroMov, 2, ',', '.');
            })
            ->editColumn('vlCOFINS', function($data){
                return "R$ " . number_format($data->vlCOFINS, 2, ',', '.');
            })
            ->editColumn('vlISSRetidoMov', function($data){
                return "R$ " . number_format($data->vlISSRetidoMov, 2, ',', '.');
            })
            ->editColumn('vlPISRetidoMov', function($data){
                return "R$ " . number_format($data->vlPISRetidoMov, 2, ',', '.');
            })
            ->editColumn('vlCSRetidoMov', function($data){
                return "R$ " . number_format($data->vlCSRetidoMov, 2, ',', '.');
            })
            ->editColumn('vlCOFINSRetidoMov', function($data){
                return "R$ " . number_format($data->vlCOFINSRetidoMov, 2, ',', '.');
            })
            ->editColumn('vlDescontoMov', function($data){
                return "R$ " . number_format($data->vlDescontoMov, 2, ',', '.');
            })
            ->editColumn('vlImpostos', function($data){
                return "R$ " . number_format($data->vlImpostos, 2, ',', '.');
            })
            ->editColumn('vlCSLL', function($data){
                return "R$ " . number_format($data->vlCSLL, 2, ',', '.');
            })
            ->toJson();
    }
}
