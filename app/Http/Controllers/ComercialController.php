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

    public function __construct(CacheManager $cache)
    {
        
        $this->cache = $cache;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('comercial.index');
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
    
    public function sugestaoCompra(){
        set_time_limit(8000000);

        $data_string = array(
            'cdFilial'=> $_GET['cdFilial'],
            'dtInicial'=> $_GET['dtInicial'],
            'dtFinal'=> $_GET['dtFinal'],
            'prazoEntrega'=> $_GET['prazoEntrega'],
            'centroCusto'=> $_GET['centroCusto'],
            'diasReposicao'=> $_GET['diasReposicao']
        );    
           
        $client = new Client(['base_uri' => 'http://api.proel.local/api/',
        'verify' => false]);
        $resp = $client->request('post', 'RelS005', [
            'headers' => [        
                'Content-type'     => 'application/json',
                'Accept' => 'application/json',
                ],
            'body' => json_encode($data_string) 
                
        ]); 

        $sugestaoCompra = $resp->getBody()->getContents();

        $data = json_decode($sugestaoCompra);
        
        //retorno formatar number_format($vtTotal, 2,',','.');
       return Datatables::of($data)->make(true);


    }
}
