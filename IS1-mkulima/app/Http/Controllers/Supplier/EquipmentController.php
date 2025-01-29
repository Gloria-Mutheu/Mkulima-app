<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Order;
use App\Models\Supplier;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
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

        $equipment = Equipment::where('supplier_id', $isSupplier->id)
            ->latest()
            ->paginate(5);

        return view('supplier.equipment')->with('equipments', $equipment);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
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

        return view('supplier.new-equipment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'hire_price' => 'required|numeric',
                'description' => 'required|string|max:255',
                'image' => 'required',
            ]

        );

        $user = Auth::user();
        $supplierId = Supplier::where('user_id', $user->id)->first()->id;

        $newEquipment = new Equipment();
        $newEquipment->name = $request->name;
        $newEquipment->hire_price =  $request->hire_price;
        $newEquipment->description = $request->description;

        $imageFile = $request->file('image')->getClientOriginalName();
        $imageName = time() . '_' . $imageFile;
        $imageName = str_replace(' ', '_', $imageName);
        $request->file('image')->storeAs('public/images/equipment', $imageName);

        $newEquipment->image_file_path = $imageName;
        $newEquipment->supplier_id = $supplierId;
        $newEquipment->save();

        if ($newEquipment) {
            // redirect to sup-fertilizer get route
            return redirect()->route('sup-equipment.index')->with('success', 'Equipment added successfully');
        }

        return redirect()->back()->with('error', 'Equipment could not be added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

        $equipment = Equipment::where('id', $id)->first();

        if (!$equipment) {
            return redirect()->back()->with('error', 'Equipment not found');
        }

        return view('supplier.update-equipment')->with('equipment', $equipment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'hire_price' => 'required|numeric',
                'description' => 'required|string|max:255',
                'image' => 'required',
            ]

        );

        $user = Auth::user();
        $supplierId = Supplier::where('user_id', $user->id)->first()->id;

        $equipment = Equipment::where('id', $id)->first();

        if (!$equipment) {
            return redirect()->back()->with('error', 'Fertilizer not found');
        }

        $equipment->name = $request->name;
        $equipment->hire_price =  $request->hire_price;
        $equipment->description = $request->description;

        $imageFile = $request->file('image')->getClientOriginalName();
        $imageName = time() . '_' . $imageFile;
        $imageName = str_replace(' ', '_', $imageName);
        $request->file('image')->storeAs('public/images/equipment', $imageName);

        $equipment->image_file_path = $imageName;
        $equipment->supplier_id = $supplierId;
        $equipment->save();

        if ($equipment) {
            // redirect to sup-fertilizer get route
            return redirect()->route('sup-equipment.index')->with('success', 'Equipment updated successfully');
        }

        return redirect()->back()->with('error', 'Equipment could not be updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $supplier = Supplier::where('user_id', $user->id)->first();

        if (!$supplier) {
            return view('supplier.create-supplier');
        }

        $equipment = Equipment::where('id', $id)->first();

        if (!$equipment) {
            return redirect()->back()->with('error', 'Equipment not found');
        }

        $equipment->delete();

        return redirect()->back()->with('success', 'Equipment deleted successfully');
    }
}