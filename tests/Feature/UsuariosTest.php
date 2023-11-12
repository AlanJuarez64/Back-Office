<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Empleado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\UsuarioController;
use Tests\TestCase;

class UsuariosTest extends TestCase
{
    use WithFaker;

    public function testRegistroUsuario()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name' => $this->faker->userName,
            'nombre_completo' => $this->faker->name,
            'ci' => $this->faker->unique()->randomNumber(8),
            'email' => $this->faker->unique()->safeEmail,
            'password' =>  'password123',
            'tipo_usuario' => 'funcionario_de_almacen'
        ];

        $response = $this->post('/usuarios', $data);
        $response->assertRedirect('/usuarios');
        $response->assertSessionHas('success_message', "Usuario {$data['name']}, con características de funcionario_de_almacen creado correctamente.");


        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

    }

    public function testRegistroConDatosIncorrectos(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name' => '',
            'nombre_completo' => $this->faker->name,
            'ci' => '12345',
            'email' => 'correo-invalido',
            'password' => '123',
            'tipo_usuario' => 'funcionario_de_almacen',
        ];

        $response = $this->post('/usuarios', $data);
        $response->assertSessionHasErrors(['name', 'ci' ,'email', 'password']);
    }

}
