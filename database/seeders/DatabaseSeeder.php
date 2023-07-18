<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'role' => UserRole::ADMIN,
            'username' => 'saulgoodman',
            'name' => 'Jimmy McGill',
            'email' => 'saul@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
