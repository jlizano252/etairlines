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
                'name' => env('ADMIN_NAME', 'Administrador ETAI'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
            ]
        );

        $users = [
            [
                'name' => 'Jessica Chaves Chaves',
                'email' => 'jschaves@etai.ac.cr',
                'password' => 'Etai2026',
            ],
            [
                'name' => 'Roberto Brenes Delangton',
                'email' => 'rbrenes@etai.ac.cr',
                'password' => 'Etai2026',
            ],
            [
                'name' => 'Jorge Chaves Blanco',
                'email' => 'jchaves@etai.ac.cr',
                'password' => 'Etai2026',
            ],
            [
                'name' => 'Luis Guillermo del Valle',
                'email' => 'ldelvalle@etai.ac.cr',
                'password' => 'Etai2026',
            ],
            [
                'name' => 'Andreina Moreira Castro',
                'email' => 'mmoreira@etai.ac.cr',
                'password' => 'Etai2026',
            ],
            [
                'name' => 'Anyi Sibaja Ulate',
                'email' => 'asibaja@etai.ac.cr',
                'password' => 'Etai2026',
            ],
            [
                'name' => 'José María Blanco',
                'email' => 'jblanco@etai.ac.cr',
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
