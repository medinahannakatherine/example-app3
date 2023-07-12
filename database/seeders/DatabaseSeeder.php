<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use Faker\Factory as FakerFactory;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = FakerFactory::create();
        
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'name' => $faker->word,
                'price' => $faker->randomFloat(2, 10, 100),
                'stock' => $faker->numberBetween(0, 100),
            ]);
        }
    }
}
