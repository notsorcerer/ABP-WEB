<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $orders = $request->user()->orders()
            ->with('items')
            ->latest()
            ->paginate(min((int) $request->query('per_page', 10), 50));

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
        if ($order->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan',
                'data' => null,
            ], 403);
        }

        $order->load('items');

        $data = (new OrderResource($order))->toArray($request);
        $data['payment_instructions'] = $this->getPaymentInstructions($order);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $cartItems = \App\Models\CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Cart masih kosong',
                'data' => null,
            ], 400);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'payment_method' => ['required', 'in:bank_transfer,ewallet,qr_code,cod'],
        ]);

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => $request->user()->id,
            'order_number' => 'INV/' . now()->format('Ymd') . '/' . strtoupper(Str::random(6)),
            'shipping_name' => $validated['name'],
            'shipping_country' => $validated['country'],
            'shipping_province' => $validated['province'],
            'shipping_city' => $validated['city'],
            'shipping_district' => $validated['district'],
            'shipping_postal_code' => $validated['zipcode'],
            'shipping_address' => $validated['address'],
            'shipping_phone' => $validated['phone'],
            'shipping_email' => $validated['email'],
            'shipping_latitude' => $validated['latitude'],
            'shipping_longitude' => $validated['longitude'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'total' => $total,
        ]);

        foreach ($cartItems as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product->name,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
                'subtotal' => $cartItem->product->price * $cartItem->quantity,
            ]);
        }

        CartItem::where('user_id', $request->user()->id)->delete();

        $order->load('items');
        $orderData = (new OrderResource($order))->toArray($request);
        $paymentInstructions = $this->getPaymentInstructions($order);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.',
            'data' => [
                'order' => $orderData,
                'payment_instructions' => $paymentInstructions,
            ],
        ], 201);
    }

    public function paymentConfirmation(Request $request, Order $order): JsonResponse
    {
        if ($order->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan',
                'data' => null,
            ], 403);
        }

        $order->load('items');

        return response()->json([
            'success' => true,
            'data' => [
                'order_number' => $order->order_number,
                'total' => (float) $order->total,
                'total_formatted' => 'Rp' . number_format($order->total, 0, ',', '.'),
                'payment_method_label' => $order->payment_method_label,
                'payment_status_label' => $order->payment_status_label,
                'payment_instructions' => $this->getPaymentInstructions($order),
            ],
        ]);
    }

    private function getPaymentInstructions(Order $order): array
    {
        $whatsappMessage = 'Halo, saya ingin konfirmasi pembayaran untuk pesanan ' . $order->order_number;

        $instructions = [
            'method' => $order->payment_method,
            'title' => $order->payment_method_label,
            'whatsapp_number' => '6282191488380',
            'whatsapp_message' => $whatsappMessage,
        ];

        $details = match ($order->payment_method) {
            'bank_transfer' => [
                'note' => 'Transfer sesuai total pesanan. Konfirmasi via WhatsApp setelah transfer.',
                'banks' => [
                    ['name' => 'BCA', 'number' => '1234567890', 'holder' => 'LiquidPedia Store'],
                    ['name' => 'Mandiri', 'number' => '0987654321', 'holder' => 'LiquidPedia Store'],
                    ['name' => 'BRI', 'number' => '1122334455', 'holder' => 'LiquidPedia Store'],
                    ['name' => 'BNI', 'number' => '5544332211', 'holder' => 'LiquidPedia Store'],
                ],
            ],
            'ewallet' => [
                'note' => 'Transfer sesuai total pesanan ke salah satu e-wallet di bawah.',
                'providers' => [
                    ['name' => 'GoPay', 'number' => '08123456789', 'holder' => 'LiquidPedia'],
                    ['name' => 'OVO', 'number' => '08123456789', 'holder' => 'LiquidPedia'],
                    ['name' => 'Dana', 'number' => '08123456789', 'holder' => 'LiquidPedia'],
                ],
            ],
            'qr_code' => [
                'note' => 'Scan QR Code di bawah menggunakan aplikasi e-wallet atau mobile banking yang mendukung QRIS.',
                'qr_image_url' => url('images/qris-liquidpedia.svg'),
            ],
            'cod' => [
                'note' => 'Bayar saat barang tiba di tempat tujuan.',
            ],
            default => [],
        };

        return array_merge($instructions, $details);
    }
}
