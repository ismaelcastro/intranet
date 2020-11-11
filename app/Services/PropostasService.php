<?php 
namespace App\Services;

use Yajra\Datatables\Datatables;
use GuzzleHttp\Client;

class PropostasService{
    public function all()
    {
        $client = new Client(['base_url' => 'https://localhost:44353/api/', verify=>false]);
        $response = $client->request('GET', 'PropostasSWE');

    }
}