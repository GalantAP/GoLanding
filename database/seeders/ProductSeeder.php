<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Menghapus semua data produk dan mereset ID
        Product::truncate();

        // Data produk yang akan di-seed
        $products = [
            [
                'name' => 'Premium Real Estate Landing Page',
                'slug' => 'premium-real-estate-landing',
                'description' => 'Modern and elegant landing page template for real estate business.',
                'price' => 299000,
                'discount_price' => 199000,
                'image' => 'https://via.placeholder.com/400x300/1a1a1a/ff0000?text=Real+Estate',
                'preview_url' => '#',
                'is_featured' => true,
                'is_new' => true,
                'category_id' => 1, // Pastikan kategori ini ada
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'E-Learning Platform Template',
                'slug' => 'e-learning-platform',
                'description' => 'Complete e-learning platform with course listings, instructor profiles, and student dashboard.',
                'price' => 499000,
                'discount_price' => 349000,
                'image' => 'https://via.placeholder.com/400x300/1a1a1a/ff0000?text=E-Learning',
                'preview_url' => '#',
                'is_featured' => true,
                'is_new' => false,
                'category_id' => 1, // Pastikan kategori ini ada
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Business Portfolio Website Template',
                'slug' => 'business-portfolio-website',
                'description' => 'A sleek and professional portfolio template for showcasing business services.',
                'price' => 159000,
                'discount_price' => 119000,
                'image' => 'https://via.placeholder.com/400x300/1a1a1a/ff6600?text=Business+Portfolio',
                'preview_url' => '#',
                'is_featured' => false,
                'is_new' => true,
                'category_id' => 2, // Pastikan kategori ini ada
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Photography Portfolio Template',
                'slug' => 'photography-portfolio',
                'description' => 'Elegant portfolio template designed for professional photographers to showcase their work.',
                'price' => 249000,
                'discount_price' => 179000,
                'image' => 'https://via.placeholder.com/400x300/1a1a1a/ff00cc?text=Photography+Portfolio',
                'preview_url' => '#',
                'is_featured' => true,
                'is_new' => true,
                'category_id' => 3, // Pastikan kategori ini ada
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Corporate Business Template',
                'slug' => 'corporate-business-template',
                'description' => 'A corporate website template with a clean and professional design suitable for businesses.',
                'price' => 399000,
                'discount_price' => 299000,
                'image' => 'https://via.placeholder.com/400x300/1a1a1a/00cc00?text=Corporate+Business',
                'preview_url' => '#',
                'is_featured' => false,
                'is_new' => false,
                'category_id' => 4, // Pastikan kategori ini ada
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Startup Landing Page Template',
                'slug' => 'startup-landing-page',
                'description' => 'A modern and interactive landing page template designed for startups to showcase their products.',
                'price' => 199000,
                'discount_price' => 149000,
                'image' => 'https://via.placeholder.com/400x300/1a1a1a/00ffcc?text=Startup+Landing',
                'preview_url' => '#',
                'is_featured' => true,
                'is_new' => true,
                'category_id' => 1, // Pastikan kategori ini ada
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Blog and News Website Template',
                'slug' => 'blog-news-website',
                'description' => 'A clean and user-friendly template for blog or news websites with multiple layouts.',
                'price' => 129000,
                'discount_price' => 99900,
                'image' => 'https://via.placeholder.com/400x300/1a1a1a/0000ff?text=Blog+News',
                'preview_url' => '#',
                'is_featured' => false,
                'is_new' => false,
                'category_id' => 5, // Pastikan kategori ini ada
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 9 more products...
            // You can repeat the same pattern as above for the rest of the 16 products
        ];

        // Insert products into the database
        Product::insert($products);
    }
}
