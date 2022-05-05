<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $id = 1;

        return [
            'name' => $this->faker->randomElement(['Open', 'Closed']),
            'id' => $id++

        ];
    }
}
