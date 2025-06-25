<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->latest()->get(); // eager load
        return view('shop.index', compact('products'));
    }
    public function view()
    {
        $products = Product::with(relations: 'category')->latest()->get(); // eager load
        return view('shop.shop', compact('products'));
    }

    public function cart()
    {
        // View cart page (implementasi real bisa gunakan session/DB)
        return view('shop.cart');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->withErrors(['Cart kosong.']);
        }

        DB::beginTransaction();
        try {
            $total = 0;
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => 0, // sementara
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
                $total += $item['price'] * $item['quantity'];
            }

            $order->update(['total' => $total]);

            DB::commit();
            session()->forget('cart');

            return redirect('/')->with('success', 'Pesanan berhasil diproses.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors(['error' => 'Checkout gagal. Silakan coba lagi.']);
        }
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        $key = $id . '-' . ($request->size ?? '') . '-' . ($request->color ?? '');

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += (int) $request->quantity;
        } else {
            $cart[$key] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => (int) $request->quantity,
                'size' => $request->size,
                'color' => $request->color,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
    public function updateCart(Request $request)
    {
        $quantities = $request->input('quantities', []);

        $cart = session('cart', []);
        foreach ($quantities as $id => $qty) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = max(1, (int) $qty);
            }
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Cart updated');
    }

    public function transactionHistory()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('shop.success', compact('orders'));
    }

}
