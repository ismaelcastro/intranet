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
            'fOrigemTitulo' => 0,
        );
        $client = new Client(['base_uri' => 'https://localhost:44353/api/', 'verify' => false]);
        $res = $client->request('post', 'RecebimentosEfetuados',[
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

            ->toJson();
    }
}
