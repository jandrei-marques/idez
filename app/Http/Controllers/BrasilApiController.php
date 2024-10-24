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
            }
            else
            {
                throw new Exception($response->status());
            }
        }
        catch (Exception $e)
        {
            $errorMessage = 'Erro ao buscar dados dos estados na BRASIL API: ' . $e->getMessage();
        }
        return view('brasil.estados.index', compact('estados', 'errorMessage'));
    }

    public function municipios($estado = null, Request $request)
    {
        if (empty($estado))
        {
            return redirect('/brasilapi');
        }
        $paginatedMunicipios = [];
        $errorMessage = $currentPage = $lastPage = null;
        try
        {
            $url = env('BRASIL_API_URL') . "/municipios/v1/$estado";
            $response = Http::withOptions(['verify' => false])->get($url);

            if ($response->successful())
            {
                $resultMunicipios = collect($response->json())->sortBy('nome');

                $perPage = 10;
                $currentPage = $request->get('page', 1);
                $paginatedMunicipios = $resultMunicipios->slice(($currentPage - 1) * $perPage, $perPage)->all();
                $lastPage = ceil($resultMunicipios->count() / $perPage);
            }
            else
            {
                throw new Exception($response->status());
            }
        }
        catch (Exception $e)
        {
            $errorMessage = 'Erro ao buscar dados dos municipios na BRASIL API: ' . $e->getMessage();
        }
        return view('brasil.municipios.index', [
            'municipios' => $paginatedMunicipios,
            'currentPage' => $currentPage,
            'errorMessage' => $errorMessage,
            'estado' => $estado,
            'lastPage' => $lastPage,
        ]);
        
    }
}
