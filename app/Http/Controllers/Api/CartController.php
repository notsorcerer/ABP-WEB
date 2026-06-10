<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $items = CartItem::with('product.category')
            ->where('user_id', $request->user()->id)
            ->get()
            ->map(function ($item) {
                $product = $item->product;
                $subtotal = $product->price * $item->quantity;
                return [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => (float) $product->price,
                    'price_formatted' => 'Rp' . number_format($product->price, 0, ',', '.'),
                    'image_url' => $product->image_url,
                    'quantity' => $item->quantity,
                    'subtotal' => $subtotal,
                    'subtotal_formatted' => 'Rp' . number_format($subtotal, 0, ',', '.'),
                ];
            });

        $total = $items->sum('subtotal');

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $items,
                'total' => $total,
                'total_formatted' => 'Rp' . number_format($total, 0, ',', '.'),
                'total_items' => $items->sum('quantity'),
            ],
        ]);
    }

    public function add(Request $request, Product $product): JsonResponse
    {
        $quantity = (int) $request->input('quantity', 1);

        $cartItem = CartItem::where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
            $cartItem->refresh();
        } else {
            $cartItem = CartItem::create([
                'user_id' => $request->user()->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        $subtotal = $product->price * $cartItem->quantity;

        $cartTotals = $this->getCartTotals($request->user()->id);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke cart',
            'data' => [
                'product_id' => $product->id,
                'quantity' => $cartItem->quantity,
                'subtotal' => $subtotal,
                'subtotal_formatted' => 'Rp' . number_format($subtotal, 0, ',', '.'),
                'cart_total' => $cartTotals['total'],
                'cart_total_formatted' => $cartTotals['total_formatted'],
                'cart_total_items' => $cartTotals['total_items'],
            ],
        ]);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $quantity = (int) $request->input('quantity', 1);

        if ($quantity < 1) {
            CartItem::where('user_id', $request->user()->id)
                ->where('product_id', $product->id)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus dari cart',
                'data' => null,
            ]);
        }

        CartItem::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'product_id' => $product->id,
            ],
            ['quantity' => max(1, $quantity)]
        );

        $subtotal = $product->price * $quantity;

        return response()->json([
            'success' => true,
            'message' => 'Cart berhasil diperbarui',
            'data' => [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
                'subtotal_formatted' => 'Rp' . number_format($subtotal, 0, ',', '.'),
            ],
        ]);
    }

    public function remove(Request $request, Product $product): JsonResponse
    {
        CartItem::where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari cart',
            'data' => null,
        ]);
    }

    private function getCartTotals(int $userId): array
    {
        $items = CartItem::with('product')
            ->where('user_id', $userId)
            ->get();

        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return [
            'total' => $total,
            'total_formatted' => 'Rp' . number_format($total, 0, ',', '.'),
            'total_items' => $items->sum('quantity'),
        ];
    }
}
