<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Client;
use App\Models\Equipment;
use App\Models\HireDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HiringEquipmentController extends Controller
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



        $hireDetails = HireDetails::with('equipment', 'supplier')
            ->where('client_id', $isClient->id)->latest()->paginate(3);


        return view('client.hired-equipment')->with('hireDetails', $hireDetails);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $equipment_id)
    {
        $userId = auth()->user()->id;

        $isClient = Client::where('user_id', $userId)->first();

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



        $equipment = Equipment::find($equipment_id);

        $equipment->load('supplier');
        $supplier_id = $equipment->supplier->id;

        $data = [
            'equipmentId' => $equipment_id,
            'supplierId' => $supplier_id,
        ];

        return view('client.hire-equipment')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =  $request->validate(
            [
                'equipment_id' => 'required',
                'supplier_id' => 'required',
                'from' => 'required|date|after_or_equal:today',
                'to' => 'required|date|after_or_equal:from',
            ]
        );

        $isEquipmentHired = HireDetails::where('equipment_id', $data['equipment_id'])
            ->where('status', 'Pending')
            ->where('client_id', auth()->user()->client->id)
            ->first();

        if ($isEquipmentHired) {
            return redirect()->back()->with('error', 'You have already hired this equipment');
        }

        $equipment = Equipment::where('id', $data['equipment_id'])->first();
        $hire_price = $equipment->hire_price;

        // Calculate the number of days between the two dates
        $from = strtotime($data['from']);
        $to = strtotime($data['to']);
        $days = ceil(abs($to - $from) / 86400) + 1;

        $totalPrice = $days * $hire_price;

        $newHireDetails = new HireDetails();
        $newHireDetails->equipment_id = $data['equipment_id'];
        $newHireDetails->supplier_id = $data['supplier_id'];
        $newHireDetails->client_id = auth()->user()->client->id;
        $newHireDetails->from = $data['from'];
        $newHireDetails->to = $data['to'];
        $newHireDetails->total_price = $totalPrice;
        $newHireDetails->status = 'Pending';
        $newHireDetails->save();

        $newHireDetails->load('equipment');

        return view('client.hire-equipment-success')->with('hireDetails', $newHireDetails);
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