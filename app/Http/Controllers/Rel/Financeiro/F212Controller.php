<?php

namespace App\Http\Controllers\Rel\Financeiro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class F212Controller extends Controller
{
	private static $url_base = 'http://192.168.1.103:7492';
	private static $json_url = '/api/RelatorioIntegracao';
    


    public function index(Request $request){	
    	$dtInicial = Carbon::createFromFormat('d/m/Y', $request->dtInicial)->format('Y-m-d');
    	$dtFinal = Carbon::createFromFormat('d/m/Y', $request->dtFinal)->format('Y-m-d');
		$json_string = json_encode(
			array(
				
				"RelatorioId" => "7f4f8d7f-310e-49f0-a021-36ee7fb1a9e5",
				"RelatorioFormato" => "EXCEL",
				"RelatorioParametroLista" => 
					array(
						array(
							"ParametroNome"=> "FilialCodigo",
							"ParametroValor" => $request->filial,
						),
						array(
							"ParametroNome" => "DataInicio",
							"ParametroValor" => $dtInicial,
					
						),
						array(
							"ParametroNome" => "DataTermino",
							"ParametroValor" => $dtFinal,
						)
					)
				)			

		);
	
		//Requisição API
		$ch = curl_init(self::$url_base.self::$json_url);
		
		$options = array(
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_POSTFIELDS => $json_string,
		CURLOPT_HTTPHEADER => array(                                                                          
    		'Content-Type: application/json',
    		),
		);
		
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);

		
		$response = json_decode($result);	
		$filename = $dtInicial."-".$dtFinal.'F212.xls';
		$tempExcel = tempnam(sys_get_temp_dir(), $filename);
		copy(self::$url_base . $response->RelatorioEndereco, $tempExcel);	
		

		return response()->download($tempExcel, $filename);
		
    }
}
