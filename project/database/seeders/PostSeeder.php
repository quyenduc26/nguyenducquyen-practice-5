<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Post::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'user_id' => $faker->numberBetween(1, 10) 
            ]);
        }
    }
}
