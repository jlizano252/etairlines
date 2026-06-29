<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@etai.local')],
            [
                'name' => env('ADMIN_NAME', 'Administrador ETAI'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
            ]
        );
    }
}
