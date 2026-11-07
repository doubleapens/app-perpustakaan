<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            ['admin@pens.ac.id', 'Admin Perpustakaan', 'admin'],
            ['petugas1@pens.ac.id', 'Petugas Satu', 'petugas'],
            ['petugas2@pens.ac.id', 'Petugas Dua', 'petugas'],
        ] as [$email, $name, $role]) {
            User::updateOrCreate(['email' => $email], [
                'name' => $name,
                'password' => Hash::make('password'),
                'role' => $role,
            ]);
        }
    }
}
