<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id dengan tipe auto increment
            $table->string('name'); // Menambahkan kolom 'name' bertipe string
            $table->string('slug')->unique(); // Menambahkan kolom 'slug' bertipe string dengan unique constraint
            $table->text('description'); // Menambahkan kolom 'description' bertipe text
            $table->decimal('price', 10, 2); // Menambahkan kolom 'price' bertipe decimal dengan panjang 10 dan 2 angka desimal
            $table->decimal('discount_price', 10, 2)->nullable(); // Menambahkan kolom 'discount_price' dengan nilai default null
            $table->string('image'); // Menambahkan kolom 'image' bertipe string
            $table->string('preview_url')->nullable(); // Menambahkan kolom 'preview_url' dengan nilai default null
            $table->boolean('is_featured')->default(false); // Menambahkan kolom 'is_featured' dengan nilai default false
            $table->boolean('is_new')->default(false); // Menambahkan kolom 'is_new' dengan nilai default false
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Menambahkan foreign key 'category_id' yang terhubung dengan tabel 'categories'
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products'); // Menghapus tabel 'products' jika migrasi dibatalkan
    }
}
