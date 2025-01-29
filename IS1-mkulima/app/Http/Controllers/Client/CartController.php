<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return redirect()->route('client.create');
        }

        $carts = Cart::where('client_id', $isClient->id)->get();

        $carts->load('fertilizer');

        foreach ($carts as $cart) {
            $cart->total_price = $cart->quantity * $cart['fertilizer'][0]['price'];
        }

        $orders = Order::with('fertilizer')
            ->where('client_id', $isClient->id);

        session([
            'cart_count' => $carts->count(),
            'order_count' => $orders->count()
        ]);

        return view('client.view-cart')->with('carts', $carts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fertilizer_id' => 'required|exists:fertilizers,id',
        ]);

        $clientId = auth()->user()->client->id;

        $cart = Cart::where('client_id', $clientId)
            ->where('fertilizer_id', $data['fertilizer_id'])
            ->first();

        if ($cart) {
            $cart->increment('quantity');
            return redirect()->route('client.cart.index')->with('success', 'Fertilizer added to cart successfully');
        }

        $newCart = Cart::create([
            'client_id' => $clientId,
            'fertilizer_id' => $data['fertilizer_id'],
            'quantity' => 1,
        ]);

        return redirect()->route('client.cart.index')->with('success', 'Fertilizer added to cart successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();
        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return redirect()->route('client.create');
        }
        $carts = Cart::where('client_id', $isClient->id)->get();
        session(['cart_count' => $carts->count()]);

        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $clientId = $user->client->id;

        $cart = Cart::where('client_id', $clientId)
            ->where('id', $id)
            ->first();

        if (!$cart) {
            return redirect()->route('client.cart.index')->with('error', 'Fertilizer not found in cart');
        }

        $cart->quantity = $data['quantity'];

        $cart->save();

        return redirect()->route('client.cart.index')->with('success', 'Fertilizer quantity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return redirect()->route('client.create');
        }

        $clientId = $user->client->id;

        $cart = Cart::where('client_id', $clientId)
            ->where('id', $id)
            ->first();

        if (!$cart) {
            return redirect()->route('client.cart.index')->with('error', 'Fertilizer not found in cart');
        }

        $cart->delete();

        return redirect()->route('client.cart.index')->with('success', 'Fertilizer removed from cart successfully');
    }
}