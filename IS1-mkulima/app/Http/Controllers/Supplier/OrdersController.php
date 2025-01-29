<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $isSupplier = Supplier::where('user_id', $user->id)->first();

        if (!$isSupplier) {
            return view('supplier.create-supplier');
        }

        $orders = Order::with('fertilizer')
            ->whereHas('fertilizer', function ($query) use ($isSupplier) {
                $query->where('supplier_id', $isSupplier->id);
            })
            ->where('status', 'pending')
            ->get();

        session([
            'manage_orders' => $orders->count()
        ]);



        //get all orders for this supplier, where fertilizer->supplier_id == supplier->id
        $supplierOrders = Order::with('fertilizer', 'client')
            //where fertilizer->supplier_id == supplier->id
            ->whereHas('fertilizer', function ($query) use ($isSupplier) {
                $query->where('supplier_id', $isSupplier->id);
            })
            ->latest()
            ->paginate(5);

        foreach ($supplierOrders as $order) {
            $client = $order->client->user;
            $order->client_name = $client->name;
        }

        return view('supplier.orders')->with('orders', $supplierOrders);
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

    public function updateStatus(string $id)
    {
        $user = Auth::user();
        $isSupplier = Supplier::where('user_id', $user->id)->first();

        if (!$isSupplier) {
            return view('supplier.create-supplier');
        }

        $order = Order::find($id);
        $order->status = 'complete';
        $order->save();

        return back()->with('success', 'Order status updated successfully');
    }
}