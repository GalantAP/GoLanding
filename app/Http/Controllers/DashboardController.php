<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Filter berdasarkan kategori
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        // Pencarian produk
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan featured atau new
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'featured':
                    $query->where('is_featured', true);
                    break;
                case 'new':
                    $query->where('is_new', true);
                    break;
                default:
                    break;
            }
        }

        // Mengambil produk dengan filter dan pagination
        $products = $query->latest()->paginate(12);

        // Mengambil kategori untuk dropdown/filter
        $categories = Category::all();

        // Mengambil produk featured untuk ditampilkan di bagian khusus
        $featuredProducts = Product::where('is_featured', true)->take(4)->get();

        // Mengembalikan view dengan data yang diperlukan
        return view('dashboard.index', compact('products', 'categories', 'featuredProducts'));
    }
}
