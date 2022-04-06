<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,20),
            'description' => $this->faker->text(100),
            'title' => ucwords($this->faker->words(2,true)),
            'image' => 'logo.png'
        ];
    }
}
