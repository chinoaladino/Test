<?php

namespace Database\Factories;

use App\Models\Perrito;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerritoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Perrito::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence(),
            'color' => $this->faker->sentence(),
            'raza_id' => $this->faker->randomElement([1,2])
        ];
    }
}
