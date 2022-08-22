<?php

namespace App\Http\Controllers;

use App\Models\PostalCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostalCodeController extends Controller
{
    public function postalCode($code)
    {
        $postalCodes = PostalCode::where('d_codigo', $code)
        ->select('d_codigo', 'd_asenta', 'd_tipo_asenta', 'D_mnpio', 'd_estado', 'd_ciudad', 'c_estado', 'c_mnpio', 'id_asenta_cpcons', 'd_zona')
        ->get();

        $data = [
            "zip_code" => $postalCodes[0]->d_codigo,
            "locality" => $this->formatText($postalCodes[0]->d_ciudad),
            "federal_entity" => [
                "key" => (int) $postalCodes[0]->c_estado,
                "name" => $this->formatText($postalCodes[0]->d_estado),
                "code" => null
            ],
            "settlements" => $this->getSettlemens($postalCodes),
            "municipality" => [
                "key" => (int) $postalCodes[0]->c_mnpio,
                "name" => $this->formatText($postalCodes[0]->D_mnpio)
            ]
        ];

        return response()->json($data);
    }

    public function getSettlemens($postalCodes)
    {
        for ($i=0; $i < count($postalCodes); $i++) { 
            $settlemens[] = [
                "key" => (int) $postalCodes[$i]->id_asenta_cpcons,
                "name" => $this->formatText($postalCodes[$i]->d_asenta),
                "zone_type" => $this->formatText($postalCodes[$i]->d_zona),
                "settlement_type" => [
                    "name" => $postalCodes[$i]->d_tipo_asenta
                ],
            ]; 
        }

        return$settlemens;
    }

    function formatText($cadena){
        $cadena = str_replace(
            array('á','Á','é','É','í','Í','ó','Ó','ú','Ú'),
            array('a','A','e','E','i','I','o','O','u','U'),
            $cadena
        );

        return Str::upper($cadena);
    }
}
