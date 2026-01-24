<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::where('email', env('ADMIN_EMAIL'))->exists()) {
            return;
        }

        User::create([
            'name' => env('ADMIN_NAME', 'Administrador'),
            'email' => env('ADMIN_EMAIL', 'admin@empresa.com'),
            'email_verified_at' => now(),
            'password' => Hash::make(
                env('ADMIN_PASSWORD', '123456')
            ),
        ]);
    }
}
