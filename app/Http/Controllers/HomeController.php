<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $bestSellers = Product::with('category')->where('is_best_seller', true)->take(4)->get();
        $newArrivals = Product::with('category')->where('is_new_arrival', true)->take(4)->get();
        $categories = Category::all();

        return view('home', compact('bestSellers', 'newArrivals', 'categories'));
    }
}
