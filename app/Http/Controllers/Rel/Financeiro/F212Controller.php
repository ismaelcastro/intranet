<?php

namespace App\Http\Controllers\Rel\Financeiro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class F212Controller extends Controller
{
	private static $url_base = 'http://192.168.1.103:7492';
	private static $json_url = '/api/RelatorioIntegracao/';
    


    public function index(Request $request){	
    	
		$json_string = json_encode(
			array(
				
				"relatorioId" => "7f4f8d7f-310e-49f0-a021-36ee7fb1a9e5",
				"relatorioFormato" => $request->ext,
				"relatorioParametroLista" => array(

					"DataInicio" => $request->dtInicial,
					"DataTermino" => $request->dtFinal,
					)
				)			

		);
		//Requisição API
		$ch = curl_init(self::$url_base.self::$json_url);

		$options = array(
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_POSTFIELDS => $json_string
		);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($result);

		$filename = 'F212.xls';
		$tempExcel = tempnam(sys_get_temp_dir(), $filename);
		copy(self::$url_base . $response->relatorioEndereco, $tempExcel );

		return response()->download($tempExcel, $filename);
		
    }
}
