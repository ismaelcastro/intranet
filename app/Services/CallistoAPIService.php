<?php
namespace App\Services;

use Yajra\Datatables\Datatables;
use GuzzleHttp\Client;

class CallistoAPIService{
    public function getJson(string $endPoint, string $method, array $dataString){

        $client = new Client(['base_uri' => 'http://api.proel.local/api/', 'verify' => false]);

        $res  = $client->request($method, $endPoint,[
            'headers' => [
                'Content-type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode($dataString)
        ]);

        return json_decode($res->getBody()->getContents());
    }
}
