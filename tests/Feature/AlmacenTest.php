<?php

namespace Tests\Feature;

use App\Models\Almacen;
use App\Models\User;
use App\Models\Empleado;
use App\Models\FuncionarioAlmacen;
use App\Models\Despachador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\AlmacenController;
use Tests\TestCase;


class AlmacenTest extends TestCase
{
    
    public function testVerTodo()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Almacen::factory()->create();

        $response = $this->get('/almacenes'); 
        $response->assertStatus(200)
        ->assertViewIs('almacenes')
        ->assertViewHas('almacenes')
        ->assertViewHas('almacenes', Almacen::all());

        foreach (Almacen::all() as $almacen) {
            $response->assertSee($almacen->nombre);

        }
    }


    public function testRegistrarAlmacen()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'Capacidad' => 20,
        ];

        $response = $this->post('/almacenes', $data);

        $response->assertStatus(200)
            ->assertViewIs('almacenes')
            ->assertViewHas('message', 'Almacén creado correctamente')
            ->assertViewHas('almacenes')
            ->assertSee('Almacén creado correctamente');

        $this->assertDatabaseHas('almacenes', $data);
    }

    public function testRegistrarAlmacenConDatosIncorrectos()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'Capacidad' => 'invalid',
        ];

        $response = $this->post('/almacenes', $data);

        $response->assertSessionHasErrors(['Capacidad']);
    }

    public function testVerMasConAlmacenExistente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $almacen = Almacen::factory()->create();

        $response = $this->get("/almacenes/{$almacen->ID_Almacen}"); 

        $response->assertStatus(200)
            ->assertViewIs('almacenInfo')
            ->assertViewHas('almacen', $almacen)
            ->assertViewHas('productos', $almacen->productos);

    }

    public function testVerMasConAlmacenNoExistente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/almacenes/999');

        $response->assertStatus(404);
    }

    public function testVerMasConAlmacenSinFuncionarios()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $almacen = Almacen::factory()->create();

        $response = $this->get("/almacenes/{$almacen->ID_Almacen}"); 

        $response->assertStatus(200)
            ->assertViewIs('almacenInfo') 
            ->assertViewHas('almacen', $almacen)
            ->assertViewHas('productos', $almacen->productos)
            ->assertViewHas('message', 'No se ha asignado un funcionario al almacén.');

    }

    public function testVerMasConAlmacenConFuncionarios()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $empleado = Empleado::factory()->create(['id' => $user->id]);
        $funcionario = FuncionarioAlmacen::factory()->create([ 'id' => $user->id]);
        $almacen = Almacen::find($funcionario->ID_Almacen);

        $response = $this->get("/almacenes/{$funcionario->ID_Almacen}");

        $response->assertStatus(200)
            ->assertViewIs('almacenInfo') 
            ->assertViewHas('almacen', $almacen)
            ->assertViewHas('productos', $almacen->productos)
            ->assertViewHas('funcionarioAlmacen', $funcionario)
            ->assertViewHas('user', $funcionario->empleado->user);
    }
}
