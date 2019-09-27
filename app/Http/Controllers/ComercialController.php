<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\Datatables\Datatables;
use GuzzleHttp\Client;
use Illuminate\Cache\CacheManager;


class ComercialController extends Controller
{
    private $cache;

    public function __construct(CacheManager $cache){
        
        $this->cache = $cache;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr_faturamento = $this->getFaturamentoC123();

        $total = 
            $arr_faturamento->faturamentoProel + 
            $arr_faturamento->faturamentoSH + 
            $arr_faturamento->faturamentoSelect+
            $arr_faturamento->faturamentoRep;

        return view('comercial.index', compact('arr_faturamento', 'total'));
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
    public function visitasPorClien(){
        
        $visitas = $this->cache->get('visitas', function(){
            $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
            $resp = $client->request('GET', 'visitasComerciais');
            $visitas = $resp->getBody()->getContents();
            $this->cache->put('visitas', $visitas, 60);           
            return $visitas;
        });     


        $data = json_decode($visitas);
        
        return Datatables::of($data)
            ->editColumn('cliente', function($row){
                return "<a href='google.com'>{$row->cliente}</a>";

            })
            ->editColumn('qtdV', function($row){
                return "<span class='badge bg-red'>{$row->qtdV}</span>";
            })
            ->rawColumns(['cliente', 'qtdV'])
            ->filter(function(){})
            ->make(true); 
           

    }

    public function getFaturamentoC123(){
        set_time_limit(60);
        $faturamento = $this->cache->get('faturamento', function(){
            $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
            $resp = $client->request('GET', 'faturamento'); 
            $faturamento = $resp->getBody()->getContents();
            $this->cache->put('faturamento', $faturamento, 180);
            return $faturamento;
        });
        
        $data = json_decode($faturamento);
        
        //retorno formatar number_format($vtTotal, 2,',','.');
       return $data;
    }
}
