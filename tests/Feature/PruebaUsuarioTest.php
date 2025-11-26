<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PruebaUsuarioTest extends TestCase
{
    use WithFaker;

    public function test_registrarse_con_datos_aleatorios()
    {
        for ($i = 0; $i < 10; $i++) {

            $password = $this->faker->password(8);

            $usuario = [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'password' => "12345678",
                'password_confirmation' => "12345678",
                'app_lector' => $this->faker->lastName,
                'apm_lector' => $this->faker->lastName,
                'edad' => $this->faker->numberBetween(1, 100),
                'fecha_nacimiento' => $this->faker->date(),
                'suscripcion' => $this->faker->boolean,
            ];

            $response = $this->post(route('persona/new'), $usuario);
            $response->assertStatus(200);
            $response->assertSessionHasNoErrors();


            $this->assertDatabaseHas('users', [
                'name' => $usuario['name'],
                'email' => $usuario['email'],
                'app_lector' => $usuario['app_lector'],
                'apm_lector' => $usuario['apm_lector'],
                'edad' => $usuario['edad'],
                'fecha_nacimiento' => $usuario['fecha_nacimiento'],
                'suscripcion' => $usuario['suscripcion']
            ]);

            //$usuarioCreado = Usuario::where('email', $usuario['email'])->first();
            //$this->assertNotNull($usuarioCreado);
            //$this->assertTrue(Hash::check($password, $usuarioCreado->password));
        }
    }
}
