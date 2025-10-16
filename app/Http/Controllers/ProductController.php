<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        // Mengambil produk berdasarkan slug dengan eager loading category
        $product = Product::with('category')
                          ->where('slug', $slug)
                          ->firstOrFail();

        // Mengambil produk terkait (produk yang memiliki kategori sama, namun tidak termasuk produk yang sedang dilihat)
        $relatedProducts = Product::with('category') // Menambahkan eager loading untuk kategori
                                  ->where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->latest() // Produk terkait diurutkan berdasarkan yang terbaru
                                  ->take(4) // Membatasi hasil produk terkait menjadi 4 produk
                                  ->get();

        // Mengembalikan view dengan data produk dan produk terkait
        return view('products.detail', compact('product', 'relatedProducts'));
    }
}
