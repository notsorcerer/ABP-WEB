<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->is_admin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBestSellers = Product::where('is_best_seller', true)->count();
        $totalNewArrivals = Product::where('is_new_arrival', true)->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('payment_status', 'pending')->count();
        $paidOrders = Order::where('payment_status', 'paid')->count();

        $productsPerCategory = CategoryResource::collection(
            Category::withCount('products')->get()
        );

        return response()->json([
            'success' => true,
            'data' => [
                'total_products' => $totalProducts,
                'total_categories' => $totalCategories,
                'total_best_sellers' => $totalBestSellers,
                'total_new_arrivals' => $totalNewArrivals,
                'total_orders' => $totalOrders,
                'pending_orders' => $pendingOrders,
                'paid_orders' => $paidOrders,
                'products_per_category' => $productsPerCategory,
            ],
        ]);
    }
}
