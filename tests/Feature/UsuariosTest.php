<?php

//Falta arreglar el testing de la funcion modificar


namespace Tests\Feature;

use App\Models\User;
use App\Models\Empleado;
use App\Models\FuncionarioTransporte;
use App\Models\FuncionarioAlmacen;
use App\Models\Chofer;
use App\Models\Despachador;
use Illuminate\Support\Facades\Hash;
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


    public function testModificarUsuario()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $newData = [
            'name' => 'nuevo_nombre',
            'nombre_completo' => 'Nuevo Nombre Completo',
            'ci' => '23334444',
            'email' => 'nuevo_email@example.com',
            'password' => 'nueva_contraseña',
        ];

        $response = $this->put("/usuarios/{$user->id}", $newData);
        
        $updatedUser = User::find($user->id);

        $response = $this->get("/usuarios");

        $this->assertEquals($newData['name'], $updatedUser->name);
        $this->assertEquals($newData['nombre_completo'], $updatedUser->Nombre_Completo);
        $this->assertEquals($newData['ci'], $updatedUser->CI);
        $this->assertEquals($newData['email'], $updatedUser->email);
        $this->assertTrue(Hash::check($newData['password'], $updatedUser->password));

        $response->assertSessionHas('success_message', "El usuario {$user->name} fue modificado correctamente");
    }


    public function testEliminarUsuario()
    {   
        $usuarioIniciado = User::factory()->create();
        $this->actingAs($usuarioIniciado);

        $user = User::factory()->create();
        $empleado = Empleado::factory()->create(['ID_Usuario' => $user->id]);
        FuncionarioAlmacen::factory()->create(['ID_Usuario' => $user->id]);

        $response = $this->delete("/usuarios/{$user->id}");

        $response->assertRedirect('/usuarios');
        $response->assertSessionHas('success_message', 'Usuario eliminado correctamente');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('empleados', ['ID_Usuario' => $user->id]);
        $this->assertDatabaseMissing('Funcionario_Almacen', ['ID_Usuario' => $user->id]);
    }

}
