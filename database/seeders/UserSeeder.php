<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'ADMIN',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        \App\Models\User::factory(10)->create();
    }
}
