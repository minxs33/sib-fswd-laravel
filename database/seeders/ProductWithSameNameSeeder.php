<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Users;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class ProductWithSameNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $categories = Categories::all(['id', 'name'])->toArray();
        $user = Users::all()->pluck('id')->toArray();

        for ($i = 0; $i < 120; ++$i) {
            $category = $faker->randomElement($categories);
            $category_id = $category['id'];
            $created_by = $faker->randomElement($user);
            $name = $category['name'].' '.$faker->word;
            $price = $faker->randomNumber(5, 6);
            $discount = $faker->randomFloat(2, 0, 25);
            $total_price = $price - (($price / 100) * $discount);

            Products::create([
                'category_id' => $category_id,
                'created_by' => $created_by,
                'name' => $name,
                'description' => $faker->sentence,
                'discount' => $discount,
                'price' => $price,
                'total_price' => intval(preg_replace('/[^\d.]/', '', $total_price)),
                'status' => $faker->randomElement(['active', 'non-active', 'waiting']),
                'stock' => $faker->randomNumber(2),
            ]);
        }
    }
}
