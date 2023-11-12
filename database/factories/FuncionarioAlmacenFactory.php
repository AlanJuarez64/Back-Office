<?php

namespace Database\Factories;

use App\Models\FuncionarioAlmacen;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionarioAlmacenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = FuncionarioAlmacen::class;

    public function definition()
    {
        return [
            'ID_Usuario' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'ID_Almacen' => function () {
                return \App\Models\Almacen::factory()->create()->ID_Almacen;
            },
        ];
    }
}
