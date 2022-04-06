<?php

namespace Database\Seeders;

use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        User::factory(20)->create();
        Idea::factory(100)->create();


        foreach (range(1, 20) as $user_id){
            foreach (range(1, 100) as $idea_id){
                if($idea_id % 2 === 0){
                    Vote::factory()->create([
                        'user_id' => $user_id,
                        'idea_id' => $idea_id
                    ]);
                }
            }
        }
    }
}
