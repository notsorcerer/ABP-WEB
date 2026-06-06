<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBestSellers = Product::where('is_best_seller', true)->count();
        $totalNewArrivals = Product::where('is_new_arrival', true)->count();
        $productsPerCategory = Category::withCount('products')->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalBestSellers',
            'totalNewArrivals',
            'productsPerCategory'
        ));
    }
}
