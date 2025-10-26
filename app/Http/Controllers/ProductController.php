<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Halaman daftar semua produk (View All Products)
     *
     * Query params yang didukung (semua opsional):
     * - search       : string (cari di name; dan di description jika kolom tersedia)
     * - category     : 'all' | '' | id | slug | name
     * - price_min    : angka harga minimum
     * - price_max    : angka harga maksimum
     * - sort         : newest|price_asc|price_desc|popular
     * - per_page     : integer (default 12)
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        /**
         * Filter: search
         * Digrup dalam closure supaya OR tidak bocor ke filter lain.
         * Hapus komentar kolom description jika memang ada pada tabel.
         */
        if ($request->filled('search')) {
            $search = trim($request->get('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
                // Jika tabel products punya kolom 'description', aktifkan baris di bawah:
                // $q->orWhere('description', 'like', "%{$search}%");
            });
        }

        /**
         * Filter: category (terima id/slug/name)
         * Abaikan kalau 'all' atau kosong
         */
        if ($request->has('category') && $request->category !== 'all' && $request->category !== '') {
            $categoryParam = $request->get('category');

            $query->whereHas('category', function ($q) use ($categoryParam) {
                if (is_numeric($categoryParam)) {
                    $q->where('id', (int) $categoryParam);
                } elseif (preg_match('/^[a-z0-9-_.]+$/i', $categoryParam)) {
                    // Anggap slug jika pola cocok; fallback ke name juga biar fleksibel
                    $q->where('slug', $categoryParam)->orWhere('name', $categoryParam);
                } else {
                    $q->where('name', $categoryParam);
                }
            });
        }

        /**
         * Filter: rentang harga (opsional)
         */
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float) $request->get('price_min'));
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float) $request->get('price_max'));
        }

        /**
         * Sorting (opsional)
         * default -> newest (created_at desc)
         * Catatan: 'popular' mengasumsikan ada kolom 'sold_count' atau 'views'
         */
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                // Ubah ke kolom yang tersedia di tabelmu, mis. 'views' atau 'sold_count'
                $query->orderBy('sold_count', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        /**
         * Pagination
         */
        $perPage = (int) ($request->get('per_page', 12)) ?: 12;
        $products = $query->paginate($perPage)->appends($request->query());

        /**
         * Kategori untuk filter dropdown
         */
        $categories = Category::all();

        /**
         * Cart count - HANYA JIKA USER SUDAH LOGIN
         */
        if (auth()->check()) {
            $cart = session()->get('cart', []);
            $cartCount = is_array($cart) ? count($cart) : 0;
        } else {
            $cartCount = 0;
        }

        return view('products.index', compact('products', 'categories', 'cartCount'));
    }

    /**
     * Detail produk berdasarkan ID
     * Sekaligus ambil produk terkait (kategori sama), exclude current id
     */
    public function detail($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        // Cart count - HANYA JIKA USER SUDAH LOGIN
        if (auth()->check()) {
            $cart = session()->get('cart', []);
            $cartCount = is_array($cart) ? count($cart) : 0;
        } else {
            $cartCount = 0;
        }

        return view('products.detail', compact('product', 'relatedProducts', 'cartCount'));
    }

    /**
     * Detail produk berdasarkan Slug
     * Sekaligus ambil produk terkait (kategori sama), exclude current id
     */
    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        // Cart count - HANYA JIKA USER SUDAH LOGIN
        if (auth()->check()) {
            $cart = session()->get('cart', []);
            $cartCount = is_array($cart) ? count($cart) : 0;
        } else {
            $cartCount = 0;
        }

        return view('products.detail', compact('product', 'relatedProducts', 'cartCount'));
    }
}
