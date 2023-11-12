<?php

namespace Database\Factories;

use App\Models\Almacen;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlmacenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Almacen::class;

    public function definition()
    {
        return [
            'Capacidad' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
