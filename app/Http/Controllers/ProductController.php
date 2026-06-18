<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $slug = request('category');
        $query = Product::with('category');

        if ($slug && $slug !== 'all') {
            $category = Category::where('slug', $slug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $search = request('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->get();
        $categories = Category::all();
        $selectedCategory = $slug ?? 'all';

        return view('products', compact('products', 'categories', 'selectedCategory', 'search'));
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('product-detail', compact('product'));
    }
}
