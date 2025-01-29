<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return redirect()->route('client.create');
        }

        $carts = Cart::where('client_id', $isClient->id)->get();
        $orders = Order::with('fertilizer')
            ->where('client_id', $isClient->id)
            ->where('status', 'pending')
            ->get();

        session([
            'cart_count' => $carts->count(),
            'order_count' => $orders->count()
        ]);

        $orders = Order::with('fertilizer')
            ->where('client_id', $isClient->id)->latest()->paginate(3);

        foreach ($orders as $order) {
            $supplier = $order->fertilizer->supplier;
            $supplier->load('user');

            $orders->supplier = $supplier;
        }


        return view('client.view-order')->with('orders', $orders);
    }

    public function create()
    {
        //
    }

    public function store()
    {
        $user = auth()->user();

        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return redirect()->route('client.create');
        }

        $cartItems = Cart::with('fertilizer')
            ->where('client_id', $isClient->id)->get();


        foreach ($cartItems as $cartItem) {
            $newOrder = new Order();
            $newOrder->client_id = $cartItem->client_id;
            $newOrder->fertilizer_id = $cartItem->fertilizer_id;
            $newOrder->quantity = $cartItem->quantity;
            $newOrder->total_price = $cartItem->quantity * $cartItem['fertilizer'][0]['price'];
            $newOrder->order_number = 'ORD-' . rand(100000, 999999);
            $newOrder->save();

            $cartItem->delete();
        }

        return redirect()->route('client.order.index');
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}