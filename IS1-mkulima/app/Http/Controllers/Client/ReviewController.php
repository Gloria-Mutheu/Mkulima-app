<?php

namespace App\Http\Controllers\Client;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index($id)
    {
        return view('client.review');
    }

    public function create($id)
    {
        $user = auth()->user();
        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return redirect()->route('client.create');
        }

        $order = Order::where('id', $id)->first();

        return view('client.review')->with('order', $order);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string',
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        $user = auth()->user();
        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return redirect()->route('client.create');
        }

        $order = Order::where('id', $data['order_id'])->first();

        $newReview = Review::create([
            'comment' => $data['comment'],
            'client_id' => $isClient->id,
            'fertilizer_id' => $order->fertilizer_id,
            'equipment_id' => null,
        ]);

        return redirect()->route('client-fertilizer.show', ['client_fertilizer' => $order->fertilizer_id])->with('success', 'Review added successfully');
    }
}