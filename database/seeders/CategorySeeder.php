<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Menonaktifkan sementara foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        // Menghapus semua data kategori dan mereset ID
        Category::truncate();

        // Data kategori yang akan di-seed
        $categories = [
            ['name' => 'Landing Page', 'slug' => 'landing-page', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'E-Commerce', 'slug' => 'e-commerce', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Portfolio', 'slug' => 'portfolio', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Corporate', 'slug' => 'corporate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Blog', 'slug' => 'blog', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Menambahkan data kategori ke dalam tabel categories
        foreach ($categories as $category) {
            Category::create($category);
        }

        // Mengaktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        
        $this->command->info('Categories seeded successfully!');
    }
}