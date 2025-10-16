<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Menentukan atribut yang dapat diisi (fillable) untuk mencegah mass assignment vulnerabilities
    protected $fillable = ['name', 'slug'];

    // Relasi satu ke banyak (one to many) dengan model Product
    public function products()
    {
        // Menentukan bahwa Category memiliki banyak Product
        return $this->hasMany(Product::class);
    }

    // Opsional: Jika perlu, dapat menambahkan casting untuk atribut yang memerlukan format tertentu
    // protected $casts = [
    //     'created_at' => 'datetime', // Jika perlu meng-cast kolom ke format datetime
    // ];
}
