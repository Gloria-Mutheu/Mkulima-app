<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Client;
use App\Models\Review;
use App\Models\Fertilizer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FertilizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return view('client.create-client');
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




        $fertilizers = Fertilizer::latest()->paginate(3);

        return view('client.fertilizer')->with('fertilizers', $fertilizers);
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
        $user = Auth::user();
        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return view('client.create-client');
        }
        $carts = Cart::where('client_id', $isClient->id)->get();
        $orders = Order::with('fertilizer')
            ->where('client_id', $isClient->id)
            ->where('status', 'pending')
            ->get();

        $reviews = Review::with('client')
            ->where('fertilizer_id', $id)
            ->get();

        foreach ($reviews as $review) {
            $review->client->name = $review->client->user->name;
            $review->client_name = $review->client->name;
        }

        session([
            'cart_count' => $carts->count(),
            'order_count' => $orders->count()
        ]);

        $fertilizer = Fertilizer::where('id', $id)->first();

        return view('client.view-fertilizer')->with('fertilizer', $fertilizer)->with('reviews', $reviews);
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