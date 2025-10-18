<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard
     * Accessible untuk semua orang (tidak perlu login)
     */
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }
        
        // Filter by category
        if ($request->has('category') && $request->category != 'all' && $request->category != '') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category);
            });
        }
        
        // Get featured products (max 4)
        $featuredProducts = (clone $query)
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();
        
        // Get latest products (12 products)
        $latestProducts = (clone $query)
            ->latest()
            ->take(12)
            ->get();
        
        // Get all categories for filter
        $categories = Category::all();
        
        return view('dashboard.index', compact('featuredProducts', 'latestProducts', 'categories'));
    }
}