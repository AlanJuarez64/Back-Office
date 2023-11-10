<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\UsuarioController;
use Tests\TestCase;

class UsuariosTest extends TestCase
{
    public function testRegistroUsuario()
    {
        $usuarioController = new UsuarioController();

        $requestData = [
            'name' => 'TestUser3',
            'nombre_completo' => 'Test User',
            'ci' => 88888888,
            'email' => 'test3@example.com',
            'password' => 'password123',
            'tipo_usuario' => 'funcionario_de_almacen'
            
        ];

        $request = new \Illuminate\Http\Request($requestData);
        $response = $usuarioController->Registrar($request);
        $expectedMessage = 'El usuario , con caracteristicas de funcionario_de_almacen creado correctamente';

        $this->assertEquals(
            trim($expectedMessage),
             $response->getSession()->get('success_message'));
    }
}
