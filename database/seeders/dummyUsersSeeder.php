<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class dummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Data User Default (Statis)
        $defaultUsers = [
            [
                'name' => 'Mas Sales',
                'email' => 'sales@gmail.com',
                'role' => 'sales',
                'password' => bcrypt('123'),
            ],
            [
                'name' => 'Mas Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('123'),
            ],
            [
                'name' => 'Mas Sales 2',
                'email' => 'sales2@gmail.com',
                'role' => 'sales',
                'password' => bcrypt('123'),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'role' => 'superadmin',
                'password' => bcrypt('123'),
            ],
        ];

        // Masukkan data user statis ke database
        foreach ($defaultUsers as $user) {
            User::create($user);
        }

        // Tambahkan 10 User Random
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'role' => $faker->randomElement(['sales', 'admin', 'superadmin']),
                'password' => bcrypt('password'), // Default password
            ]);
        }
    }
}
