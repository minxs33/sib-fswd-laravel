<?php

namespace Database\Seeders;

use App\Models\Users;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        Users::create([
            'role' => 1,
            'avatar' => 'default.jpg',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
        ]);
        Users::create([
            'role' => 2,
            'avatar' => 'default.jpg',
            'name' => 'staff',
            'email' => 'staff@staff.com',
            'email_verified_at' => now(),
            'password' => Hash::make('staff'),
        ]);
        Users::create([
            'role' => 3,
            'avatar' => 'default.jpg',
            'name' => 'user',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user123'),
        ]);

        // for ($i = 0; $i < 5; $i++) {
        //     Users::create([
        //         'role' => $faker->numberBetween(1, 2),
        //         'avatar' => 'default.jpg',
        //         'name' => $faker->name,
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password')
        //     ]);
        // }
    }
}
