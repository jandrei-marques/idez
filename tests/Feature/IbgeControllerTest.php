<?php

namespace Tests\Feature;

use Tests\TestCase;

class IbgeControllerTest extends TestCase
{
    public function test_index(): void
    {
        $response = $this->get('/ibge');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'nome',
                'sigla',
                'regiao' => [
                    'id',
                    'nome',
                    'sigla'
                ]
            ]
        ]);
    }

    public function test_valid_municipios()
    {
        $uf = '12'; // id do acre
        $response = $this->get("/ibge/municipios/{$uf}");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'nome',
                'microrregiao' => [
                    'id',
                    'nome',
                    'mesorregiao' => [
                        'id',
                        'nome',
                        'UF' => [
                            'id',
                            'sigla',
                            'nome',
                            'regiao' => [
                                'id',
                                'sigla',
                                'nome',
                            ]
                        ]
                    ]
                ],
                'regiao-imediata' => [
                    'id',
                    'nome',
                    'regiao-intermediaria' => [
                        'id',
                        'nome',
                        'UF' => [
                            'id',
                            'sigla',
                            'nome',
                            'regiao' => [
                                'id',
                                'sigla',
                                'nome',
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function test_invalid_municipios()
    {
        $uf = '1200'; // id inexistente
        $response = $this->get("/ibge/municipios/{$uf}");
        $response->assertStatus(404);
    }
}
