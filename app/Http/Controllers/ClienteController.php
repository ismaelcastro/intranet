<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Customers;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $client = new Client();
        $res = $client->request('GET', 'http://api.proel.local/api/clientes');
        
        $customers = json_decode($res->getBody()->getContents());
        $customers_data = [];
        foreach($customers as $c){
           $data = [
                'id' => $c->cdCliente,
                'cgc' => $c->CGC,
                'name' => $c->RazaoSocial,
                'nickName' => $c->nmEntCli,
                'phone' => $c->Fone1,
                'mailSPED' => $c->emailSPED,
                'typePerson' => $c->tpPessoa,
                'typecustomer' => $c->tpEntCli
           ];
           array_push( $customers_data, $data);
        }
        foreach($customers_data as $c){
            Customers::updateOrCreate($c);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
