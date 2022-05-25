<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Canducci\ZipCode\Facades\ZipCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CepController extends Controller
{
    //
    /**
     * Retrieve the data of each cep arrived
     * 
     * @return Illuminate\Http\Response
     */
    public function retrieveCepData(Request $request, Response $response)
    {
        $response->header("Content-Type", "application/json;charset=utf-8");

        // Check if has multiple ceps in entire get request
        if (str_contains($request->ceps, ',')) {
            // Separation of cep's string
            $ceps = explode(",", $request->ceps);
            $zipCodeResults = [];

            // For each cep founded, search your ViaCep matching data as Object and add a 'label' property
            foreach ($ceps as $cep) {
                $zipCodeResult = ZipCode::find($cep)->getObject();
                $zipCodeResult->label = ($zipCodeResult->logradouro) . ", " . ($zipCodeResult->localidade);
                array_push($zipCodeResults, $zipCodeResult);
            }

            // Return the response as JSON format
            return response()->json(
                $zipCodeResults,
                200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE
            );

        } else {
            // Retrieve ViaCep data as Object and add a 'label' property
            $zipCodeResult = ZipCode::find($request->ceps)->getObject();
            $zipCodeResult->label = ($zipCodeResult->logradouro) . ", " . ($zipCodeResult->localidade);

            // Return the response as JSON format
            return response()->json(
                $zipCodeResult,
                200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        }
    }
}
