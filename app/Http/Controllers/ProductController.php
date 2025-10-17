<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua kategori untuk dropdown
        $categories = Category::all();

        // Memulai query untuk mengambil produk
        $query = Product::query();

        // Filter berdasarkan nama produk
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Ambil produk yang telah difilter
        $featuredProducts = $query->get();

        // Mengembalikan view dengan data produk dan kategori
        return view('dashboard.index', compact('featuredProducts', 'categories'));
    }

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
