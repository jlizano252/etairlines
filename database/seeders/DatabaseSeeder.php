<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador principal
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'jlizano@iacsa.cr')],
            [
                'name' => env('ADMIN_NAME', 'Jenhson Lizano'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Etai2026')),
            ]
        );

        $users = [
            [
                'name' => 'Dafne Calvo',
                'email' => 'dcalvo@iacsa.cr',
                'password' => 'Etai2026',
            ],
            [
                'name' => 'Joselyn Hernández',
                'email' => 'jhernandez@iacsa.cr',
                'password' => 'Etai2026',
            ],
            [
                'name' => 'Anthony Javier Campos Centeno',
                'email' => 'acampos@iacsa.cr',
                'password' => 'AJCC2026',
            ],
            [
                'name' => 'Marieth Soto',
                'email' => 'msoto@iacsa.cr',
                'password' => 'Etai2026',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                ]
            );
        }
    }
}
