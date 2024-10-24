<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrasilApiControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('/brasilapi');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                "id",
                "sigla",
                "nome",
                "regiao" => [
                    "id",
                    "sigla",
                    "nome",
                ]
            ]
        ]);
    }

    public function test_valid_municipios()
    {
        $uf = 'RO'; // uf de rondonia
        $response = $this->get("/brasilapi/municipios/{$uf}");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'nome',
                'codigo_ibge'
            ]
        ]);
    }

    public function test_invalid_municipios()
    {
        $uf = 'RT'; // UF inexistente
        $response = $this->get("/brasilapi/municipios/{$uf}");
        $response->assertStatus(404);
    }
}
