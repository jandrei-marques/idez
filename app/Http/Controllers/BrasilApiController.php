<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class BrasilApiController extends Controller
{

    public function index()
    {
        $estados = [];
        $errorMessage = null;
        try
        {
            $url = env('BRASIL_API_URL') . "/uf/v1";
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
            $errorMessage = 'Erro ao buscar dados dos estados na BRASIL API: ' . $e->getMessage();
        }
        return view('brasil.estados.index', compact('estados', 'errorMessage'));
    }

    public function municipios($estado)
    {
        if (empty($estado)) {
            return redirect('/brasilapi');
        }
        $municipios = [];
        $errorMessage = null;
        try
        {
            $url = env('BRASIL_API_URL') . "/municipios/v1/{$estado}";
            $response = Http::withOptions(['verify' => false])->get($url);

            if ($response->successful())
            {
                $municipios = collect($response->json())->sortBy('nome');
            }else{
                throw new Exception($response->status());
            }
        }
        catch (Exception $e)
        {
            $errorMessage = 'Erro ao buscar dados dos municipios na BRASIL API: ' . $e->getMessage();
        }
        return view('brasil.municipios.index', compact('municipios', 'errorMessage'));
    }
}
