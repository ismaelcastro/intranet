<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\Datatables\Datatables;
use GuzzleHttp\Client;

class ComercialController extends Controller
{
    public function __construct(){
        header('Acess-Control-Allow-Origin: *');
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
    public function visitasPorClien(){
        // $url = "http://127.0.0.1:8000/api/visitasComerciais";
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $resp = curl_exec($ch);
        // curl_close($ch);
        // dd($resp);
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $resp = $client->request('GET', 'visitasComerciais'); 
        $visitas = $resp->getBody()->getContents();


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
}
