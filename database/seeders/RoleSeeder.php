<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;
use Faker\Factory as FakerFactory;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin','staff','user'];

        foreach ($roles as $role){
            Roles::create([
                "role_name" => $role,
            ]);
        }

    }
}
