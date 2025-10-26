<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    /**
     * Display the dashboard
     * Akses publik (tidak perlu login)
     *
     * Query params yang didukung (semua opsional):
     * - search       : string, cari pada name (dan description jika ada kolom)
     * - category     : 'all' | '' | id | slug | name
     * - price_min    : angka harga minimum
     * - price_max    : angka harga maksimum
     * - sort         : newest|price_asc|price_desc|popular
     */
    public function index(Request $request)
    {
        // Base query dengan eager load category
        $query = Product::with('category');

        /**
         * Filter: search
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
         * Filter: category (menerima id / slug / name)
         * Abaikan jika 'all' atau kosong
         */
        if ($request->has('category') && $request->category !== 'all' && $request->category !== '') {
            $categoryParam = $request->get('category');

            // Deteksi tipe category param: id numerik, slug (alfanumerik dengan strip), atau name
            $query->whereHas('category', function ($q) use ($categoryParam) {
                if (is_numeric($categoryParam)) {
                    $q->where('id', (int) $categoryParam);
                } elseif (preg_match('/^[a-z0-9-_.]+$/i', $categoryParam)) {
                    // Asumsikan slug jika cocok pola slug; fallback ke name juga agar fleksibel
                    $q->where('slug', $categoryParam)->orWhere('name', $categoryParam);
                } else {
                    // Fallback ke name
                    $q->where('name', $categoryParam);
                }
            });
        }

        /**
         * Filter: price range (opsional)
         */
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float) $request->get('price_min'));
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float) $request->get('price_max'));
        }

        /**
         * Sorting (opsional)
         * default: newest (created_at desc)
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
                // Jika punya kolom 'sold_count' atau 'views', sesuaikan di sini
                $query->orderBy('sold_count', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        /**
         * Featured products (maks 4)
         * Menggunakan clone agar filter lain ikut terapkan (search/category/price)
         */
        $featuredProducts = (clone $query)
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        /**
         * Latest products (12 item)
         * Menggunakan clone dari query yang sudah difilter & sorted
         */
        $latestProducts = (clone $query)
            ->take(12)
            ->get();

        /**
         * Daftar kategori untuk filter
         * Cache 60 menit agar ringan
         */
        $categories = Cache::remember('dashboard_categories_all', 60 * 60, function () {
            return Category::all();
        });

        /**
         * Hitung jumlah item di cart (dari session) HANYA JIKA USER SUDAH LOGIN
         * Jika belum login, jangan akses session cart & set 0.
         */
        if (auth()->check()) {
            $cart = session()->get('cart', []);
            $cartCount = is_array($cart) ? count($cart) : 0;
        } else {
            $cartCount = 0;
        }

        /**
         * Kembalikan ke view
         * View: resources/views/dashboard/index.blade.php
         * Variabel: $featuredProducts, $latestProducts, $categories, $cartCount
         */
        return view('dashboard.index', compact('featuredProducts', 'latestProducts', 'categories', 'cartCount'));
    }
}
