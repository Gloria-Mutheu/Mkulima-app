<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
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
        $orders = Order::with('fertilizer')
            ->where('client_id', $isClient->id)
            ->where('status', 'pending')
            ->get();

        session([
            'cart_count' => $carts->count(),
            'order_count' => $orders->count()
        ]);



        $cartItems = Cart::where('client_id', $isClient->id)->get();

        $totalItems = $cartItems->count();
        $totalQuantity = $cartItems->sum('quantity');
        $totalPrice = 0;

        foreach ($cartItems as  $cartItem) {
            $totalPrice += $cartItem->quantity * $cartItem['fertilizer'][0]['price'];
        }

        $data = [
            'totalItems' => $totalItems,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
            'cartItems' => $cartItems,
        ];

        return view('client.checkout')->with('data', $data);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}