<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
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

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
