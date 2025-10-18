<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Method untuk halaman View All Products
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category', 'all');
        
        // Query produk dengan kategori
        $query = Product::with('category');
        
        // Filter berdasarkan search
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }
        
        // Filter berdasarkan kategori
        if ($category !== 'all') {
            $query->whereHas('category', function($q) use ($category) {
                $q->where('name', $category);
            });
        }
        
        // Ambil semua produk dengan pagination
        $products = $query->orderBy('created_at', 'desc')->paginate(12);
        
        // Ambil semua kategori untuk filter
        $categories = Category::all();
        
        return view('products.index', compact('products', 'categories'));
    }
    
    // Method untuk detail produk by ID
    public function detail($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.detail', compact('product'));
    }
    
    // Method untuk detail produk by Slug
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        return view('products.detail', compact('product'));
    }
}