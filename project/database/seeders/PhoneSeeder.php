<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Phone;
use App\Models\User;
use Faker\Factory as Faker;

class PhoneSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) { 
            Phone::create([
                'number' => $faker->phoneNumber,
                'user_id' => $faker->numberBetween(1, 10)
            ]);
        }
    }
}

