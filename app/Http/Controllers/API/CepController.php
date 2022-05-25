<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CepController extends Controller
{
    //
    /**
     * Retrieve the resource of each cep arrived
     * 
     * @return JSON
     */
    public function retrieveCepData(Request $request) 
    {
        if(str_contains($request->ceps, ',')) {
            //
            $cepList = explode(",", $request->ceps);

            

        } else {

        }

    }
}
