<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menentukan atribut yang dapat diisi (fillable) untuk mencegah mass assignment vulnerabilities
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'image',
        'preview_url',
        'is_featured',
        'is_new',
        'category_id',
    ];

    // Menentukan casting untuk beberapa atribut
    protected $casts = [
        'is_featured' => 'boolean', // Meng-cast kolom 'is_featured' sebagai boolean
        'is_new' => 'boolean', // Meng-cast kolom 'is_new' sebagai boolean
        'price' => 'decimal:2', // Meng-cast kolom 'price' sebagai decimal dengan 2 angka desimal
        'discount_price' => 'decimal:2', // Meng-cast kolom 'discount_price' sebagai decimal dengan 2 angka desimal
    ];

    // Relasi belongsTo untuk kategori produk
    public function category()
    {
        return $this->belongsTo(Category::class); // Produk milik satu kategori
    }

    // Menghitung persentase diskon, jika ada
    public function getDiscountPercentageAttribute()
    {
        // Jika ada harga diskon dan harga asli lebih besar dari 0
        if ($this->discount_price && $this->price > 0) {
            // Menghitung persentase diskon
            return round((($this->price - $this->discount_price) / $this->price) * 100);
        }
        return 0; // Jika tidak ada diskon atau harga 0, kembalikan 0
    }
}
