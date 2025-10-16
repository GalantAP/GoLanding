<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Menghapus semua data user dan mereset ID
        User::truncate();

        // Menambahkan user baru
        User::create([
            'name' => 'Admin GoLanding',
            'email' => 'admin@golanding.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Demo User',
            'email' => 'demo@golanding.com',
            'password' => Hash::make('demo123'),
        ]);
    }
}
