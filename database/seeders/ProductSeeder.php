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
            $price = $faker->randomNumber(4,5);
            $discount = $faker->randomFloat(2,0,25);
            $total_price = $price - (($price / 100) * $discount);

            Products::create([
                'category_id' => $category_id,
                'created_by' => $created_by,
                'name' => $faker->word,
                'description' => $faker->sentence,
                'discount' => $discount,
                'price' => $price,
                'total_price' => intval(preg_replace('/[^\d.]/', '', $total_price)),
                'status' => $faker->randomElement(['active', 'non-active']),
                'stock' => $faker->randomNumber(2),
            ]);
        }
    }
}
