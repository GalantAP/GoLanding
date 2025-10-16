<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use DB;

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
            ['name' => 'Landing Page', 'slug' => 'landing-page'],
            ['name' => 'E-Commerce', 'slug' => 'e-commerce'],
            ['name' => 'Portfolio', 'slug' => 'portfolio'],
            ['name' => 'Corporate', 'slug' => 'corporate'],
            ['name' => 'Blog', 'slug' => 'blog'],
        ];

        // Menambahkan data kategori ke dalam tabel categories
        foreach ($categories as $category) {
            Category::create($category);
        }

        // Mengaktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
