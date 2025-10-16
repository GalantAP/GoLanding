<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id dengan tipe auto increment
            $table->string('name'); // Menambahkan kolom 'name' bertipe string
            $table->string('slug')->unique(); // Menambahkan kolom 'slug' bertipe string dengan unique constraint
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories'); // Menghapus tabel 'categories' jika migrasi dibatalkan
    }
}
