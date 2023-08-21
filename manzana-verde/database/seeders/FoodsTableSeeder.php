<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Foods;
use Faker\Factory as Faker;

class FoodsTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Foods::create([
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'photo' => $faker->imageUrl(),
            ]);
        }
    }
}

