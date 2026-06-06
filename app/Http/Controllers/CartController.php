<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        if (!empty($cart)) {
            $products = Product::with('category')->whereIn('id', array_keys($cart))->get()->map(function ($product) use ($cart) {
                $product->quantity = $cart[$product->id];
                $product->subtotal = $product->price * $product->quantity;
                return $product;
            });
            $total = $products->sum('subtotal');
        } else {
            $products = collect();
        }

        return view('cart', compact('products', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke cart!');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($quantity < 1) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart berhasil diperbarui!');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari cart!');
    }

    public function showCheckoutForm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart masih kosong!');
        }

        $products = Product::with('category')->whereIn('id', array_keys($cart))->get()->map(function ($product) use ($cart) {
            $product->quantity = $cart[$product->id];
            $product->subtotal = $product->price * $product->quantity;
            return $product;
        });

        $total = $products->sum('subtotal');

        return view('checkout', compact('products', 'total'));
    }

    public function processOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart masih kosong!');
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

        $products = Product::whereIn('id', array_keys($cart))->get()->map(function ($product) use ($cart) {
            $product->quantity = $cart[$product->id];
            $product->subtotal = $product->price * $product->quantity;
            return $product;
        });

        $total = $products->sum('subtotal');

        $order = Order::create([
            'user_id' => auth()->id(),
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

        foreach ($products as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $product->quantity,
                'price' => $product->price,
                'subtotal' => $product->subtotal,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.payment-confirmation', $order)
            ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    public function showPaymentConfirmation(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items');

        $paymentDetails = match ($order->payment_method) {
            'bank_transfer' => [
                'banks' => [
                    ['name' => 'BCA', 'number' => '1234567890', 'holder' => 'LiquidPedia Store'],
                    ['name' => 'Mandiri', 'number' => '0987654321', 'holder' => 'LiquidPedia Store'],
                    ['name' => 'BRI', 'number' => '1122334455', 'holder' => 'LiquidPedia Store'],
                    ['name' => 'BNI', 'number' => '5544332211', 'holder' => 'LiquidPedia Store'],
                ],
                'note' => 'Transfer sesuai total pesanan. Konfirmasi via WhatsApp setelah transfer.',
            ],
            'ewallet' => [
                'providers' => [
                    ['name' => 'GoPay', 'number' => '08123456789', 'holder' => 'LiquidPedia'],
                    ['name' => 'OVO', 'number' => '08123456789', 'holder' => 'LiquidPedia'],
                    ['name' => 'Dana', 'number' => '08123456789', 'holder' => 'LiquidPedia'],
                ],
            ],
            'qr_code' => [
                'image' => asset('images/qris-liquidpedia.svg'),
                'note' => 'Scan QR Code di atas menggunakan aplikasi e-wallet atau mobile banking yang mendukung QRIS.',
            ],
            'cod' => [
                'note' => 'Bayar saat barang tiba di tempat tujuan.',
            ],
            default => [],
        };

        return view('checkout.payment-confirmation', compact('order', 'paymentDetails'));
    }
}
