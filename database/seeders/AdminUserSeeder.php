<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bozamarinesolutions.com'],
            [
                'name' => 'Boza Marine Admin',
                'password' => Hash::make('BozaMarine#2026'),
                'email_verified_at' => now(),
            ]
        );
    }
}
