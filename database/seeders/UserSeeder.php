<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'superuser@app.com'],
            [
                'name' => 'Super Administrator',
                'role' => UserRole::Superuser->value,
                'password' => Hash::make('secret'),
            ]
        );
        
        User::firstOrCreate(
            ['email' => 'admin@app.com'],
            [
                'name' => 'General Admin',
                'role' => UserRole::Admin->value,
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@app.com'],
            [
                'name' => 'Basic User',
                'role' => UserRole::User->value,
                'password' => Hash::make('password'),
            ]
        );
    }
}
