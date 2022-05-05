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
        static $id = 1;
        return [
            'user_id' => $this->faker->numberBetween(1,20),
            // 'status_id' => $this->faker->numberBetween(1,20),
            'description' => $this->faker->text(100),
            'title' => ucwords($this->faker->words(2,true)),
            'image' => $this->faker->randomElement(['logo.png', 'sm.png', 'dm.png', 'fm.png', 'gm.png', 'hm.png']),
            'image_second' => $this->faker->randomElement(['dm.png','hm.png','logo.png',   'sm.png', 'gm.png', 'fm.png']),
            'status_id' => $id++,
            'spams' => $this->faker->numberBetween(1,400),
            'votes' => $this->faker->numberBetween(1,1000),
            'status' => $this->faker->randomElement(['Open', 'Closed']),
            'idea_type' => $this->faker->numberBetween(1,2),
            'created_at'=>$this->faker->dateTimeBetween('-100 day' ),
        ];
    }
}
