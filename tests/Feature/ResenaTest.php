<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Libro;
use App\Models\Resena;

class ResenaTest extends TestCase
{
    use WithFaker;

    public function test_crear_resena_aleatoria()
    {
        $libro = [
            'id_libro' => 1,
            'descripcion' => $this->faker->paragraph(),
            'resena' => $this->faker->paragraph(),
        ];

        $response = $this->postJson(route('resena/new'), $libro);
        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('resena', [
            'id_libro' => $libro['id_libro'],
            'descripcion' => $libro['descripcion'],
            'resena' => $libro['resena'],
        ]);
    }
}
