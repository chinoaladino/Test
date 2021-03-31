<?php

namespace Database\Factories;

use App\Models\Razas;
use Illuminate\Database\Eloquent\Factories\Factory;

class RazasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Razas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombreRaza' => $this->faker->sentence()
        ];
    }
}
