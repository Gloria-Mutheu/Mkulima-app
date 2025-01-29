<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Client;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isAdmin = Admin::where('user_id', $user->id)->first();

        if (!$isAdmin) {
            return redirect()->route('dashboard');
        }

        return view('admin.index');
    }

    public function viewOrders()
    {
        $user = auth()->user();
        $isAdmin = Admin::where('user_id', $user->id)->first();

        if (!$isAdmin) {
            return redirect()->route('dashboard');
        }

        $orders = Order::with('fertilizer', 'client')->latest()->paginate(10);

        foreach ($orders as $order) {
            $supplier = $order->fertilizer->supplier;
            $order->supplier = $supplier;
        }

        return view('admin.view-orders')->with('orders', $orders);
    }

    public function viewClients()
    {
        $user = auth()->user();
        $isAdmin = Admin::where('user_id', $user->id)->first();

        if (!$isAdmin) {
            return redirect()->route('dashboard');
        }

        $clients = Client::with('user')->latest()->paginate(10);

        return view('admin.view-clients', compact('clients'));
    }

    public function viewSuppliers()
    {
        $user = auth()->user();
        $isAdmin = Admin::where('user_id', $user->id)->first();

        if (!$isAdmin) {
            return redirect()->route('dashboard');
        }

        $suppliers = Supplier::with('user')->latest()->paginate(10);


        return view('admin.view-suppliers', compact('suppliers'));
    }
}