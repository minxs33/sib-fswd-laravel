<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;
use Faker\Factory as FakerFactory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            $category_id = $faker->numberBetween(1, 4);
            $created_by = $faker->numberBetween(1, 10);
    
            Products::create([
                'category_id' => $category_id,
                'created_by' => $created_by,
                'name' => $faker->word,
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 10, 100),
                'status' => $faker->randomElement(['active', 'non-active']),
                'stock' => $faker->randomNumber(2),
            ]);
        }
    }
}
