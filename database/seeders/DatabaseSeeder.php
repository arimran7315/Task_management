<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'arimran7315@gmail.com',
                'password' => Hash::make('123'),
                'status' => 1,
                'role' => 'Admin',
            ],
            [
                'name' => 'Manager',
                'email' => 'arimran1058@gmail.com',
                'password' => Hash::make('123'),
                'status' => 1,
                'role' => 'Manager',
            ],
            [
                'name' => 'Abdul Rehman',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('123'),
                'status' => 1,
                'role'=>'User'
            ]
        ]);
    }
}
