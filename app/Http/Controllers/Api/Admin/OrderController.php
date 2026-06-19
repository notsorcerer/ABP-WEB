<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->is_admin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $query = Order::with('items', 'user');

        if ($status = $request->query('payment_status')) {
            $query->where('payment_status', $status);
        }

        $perPage = min((int) $request->query('per_page', 20), 50);
        $orders = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => OrderResource::collection($orders),
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ],
        ]);
    }

    public function show(Request $request, Order $order): JsonResponse
    {
        if (!$request->user()->is_admin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $order->load('items', 'user');

        $data = (new OrderResource($order))->toArray($request);
        $data['user'] = $order->user ? [
            'id' => $order->user->id,
            'name' => $order->user->name,
            'email' => $order->user->email,
        ] : null;

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function updatePaymentStatus(Request $request, Order $order): JsonResponse
    {
        if (!$request->user()->is_admin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'payment_status' => 'required|in:paid,cancelled',
        ]);

        if ($order->payment_status === 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan sudah lunas, tidak bisa diubah',
                'data' => null,
            ], 400);
        }

        if ($order->payment_status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan sudah dibatalkan, tidak bisa diubah',
                'data' => null,
            ], 400);
        }

        $order->update(['payment_status' => $validated['payment_status']]);
        $order->load('items');

        return response()->json([
            'success' => true,
            'message' => 'Status pembayaran berhasil diperbarui',
            'data' => new OrderResource($order),
        ]);
    }
}
