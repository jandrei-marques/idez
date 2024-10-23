<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class IbgeController extends Controller
{
    public function index()
    {
        $estados = [];
        $errorMessage = null;
        try
        {
            $url = env('IBGE_API_URL');
            $response = Http::withOptions(['verify' => false])->get($url);

            if ($response->successful())
            {
                $estados = collect($response->json())->sortBy('nome');
            }else{
                throw new Exception($response->status());
            }
        }
        catch (Exception $e)
        {
            $errorMessage = 'Erro ao buscar dados dos estados na API IBGE: ' . $e->getMessage();
        }
        return view('ibge.estados.index', compact('estados', 'errorMessage'));
    }

    public function municipios($uf = null)
    {
        if (empty($uf)) {
            return redirect('/brasilapi');
        }
        $municipios = [];
        $errorMessage = null;
        
        try
        {
            $url = env('IBGE_API_URL') . "/$uf/municipios";
            $response = Http::withOptions(['verify' => false])->get($url);
            if ($response->successful())
            {
                $municipios = collect($response->json())->sortBy('nome');
                if(!count($municipios))
                {
                    throw new Exception('UF não encontrada');
                }
            }else{
                throw new Exception($response->status());
            }
        }
        catch (Exception $e)
        {
            $errorMessage = 'Erro ao buscar dados dos municipios na API IBGE: ' . $e->getMessage();
        }

        return view('ibge.municipios.index', compact('municipios', 'errorMessage'));
    }
}
