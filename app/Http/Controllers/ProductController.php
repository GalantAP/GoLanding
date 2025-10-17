<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk dengan filter pencarian & kategori.
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk dropdown
        $categories = Category::orderBy('name')->get();

        // Mulai query dengan eager loading kategori untuk efisiensi
        $query = Product::with('category');

        // Filter berdasarkan nama produk (search)
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Urutkan terbaru dan paginasi (ubah 12 sesuai kebutuhan)
        // Jika tidak ingin paginasi, bisa ganti ->paginate(...) menjadi ->get()
        $featuredProducts = $query->latest()->paginate(12)->withQueryString();

        // Kembalikan ke view
        return view('dashboard.index', compact('featuredProducts', 'categories'));
    }

    /**
     * Detail produk berdasarkan slug.
     * Tetap dipertahankan jika routing kamu menggunakan slug.
     */
    public function show($slug)
    {
        // Ambil produk by slug + eager loading category
        $product = Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        // Produk terkait (kategori sama, bukan produk ini)
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('products.detail', compact('product', 'relatedProducts'));
    }

    /**
     * Detail produk berdasarkan ID (sesuai permintaan).
     * Mengembalikan view 'products.detail' hanya dengan variabel $product.
     */
    public function detail($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return view('products.detail', compact('product'));
    }
}
