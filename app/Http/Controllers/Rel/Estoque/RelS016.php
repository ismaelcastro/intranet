<?php

namespace App\Http\Controllers\Rel\Estoque;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use GuzzleHttp\Client;

class RelS016 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        set_time_limit(8000000);
        $data_string = array(
            'cdFilial'=> $request->cdFilial,
            'dtBalanco' => $request->dtBalanco,
            'ClassificacaoProduto' => $request->ClassificacaoProduto,
        );

        $client = new Client(['base_uri' => 'http://api.proel.local/api/', 'verify' => false]);

        $res = $client->request('post', 'balancobi',[
                'headers' => [
                    'Content-type' => 'application/json',
                    'Accept' => 'application/json',
                    ],
                'body' => json_encode($data_string)
                ]);
        $data = json_decode( $res->getBody()->getContents() );
        return Datatables::of($data)
            ->editColumn('vlFinanceiro', function($data){
            $valor = str_replace('.',',', $data->vlFinanceiro);
            return "R$ " . "$valor";
            })
            ->editColumn('vlPrecoMedio', function ($data){
                $valor = str_replace('.' ,',', $data->vlPrecoMedio);
                return "R$ " . $valor;
            })
            ->editColumn('qtSaldo', function($data){
                $valor  = number_format((int) $data->qtSaldo, 0);
                return "$valor";
            })
            ->rawColumns(['vlFinanceiro'])
            ->toJson();


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
