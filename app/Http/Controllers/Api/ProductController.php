<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::with('category');

        if ($slug = $request->query('category')) {
            $category = Category::where('slug', $slug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $perPage = min((int) $request->query('per_page', 10), 50);
        $products = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($products),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
        ]);
    }

    public function home(): JsonResponse
    {
        $bestSellers = ProductResource::collection(
            Product::with('category')->where('is_best_seller', true)->take(4)->get()
        );

        $newArrivals = ProductResource::collection(
            Product::with('category')->where('is_new_arrival', true)->take(4)->get()
        );

        $categories = \App\Http\Resources\CategoryResource::collection(
            Category::withCount('products')->get()
        );

        return response()->json([
            'success' => true,
            'data' => [
                'best_sellers' => $bestSellers,
                'new_arrivals' => $newArrivals,
                'categories' => $categories,
            ],
        ]);
    }

    public function show(Product $product): JsonResponse
    {
        $product->load('category');

        return response()->json([
            'success' => true,
            'data' => new ProductResource($product),
        ]);
    }
}
