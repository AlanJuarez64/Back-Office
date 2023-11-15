<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Empleado::class;

    public function definition()
    {
        return [
            'id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
        ];
    }
}
