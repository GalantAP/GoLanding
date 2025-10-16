<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Menjalankan Seeder secara berurutan
        $this->call([
            UserSeeder::class,    // Seeder untuk tabel 'users'
            CategorySeeder::class, // Seeder untuk tabel 'categories'
            ProductSeeder::class,  // Seeder untuk tabel 'products'
        ]);
    }
}
