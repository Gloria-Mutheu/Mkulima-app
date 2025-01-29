<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use App\Models\Equipment;
use App\Models\Fertilizer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'query' => 'required|string',
        ]);

        $user = Auth::user();
        $isClient = Client::where('user_id', $user->id)->first();

        if (!$isClient) {
            return redirect()->route('client.create');
        }

        $query = $data['query'];

        $fertilizers = Fertilizer::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        $equipment = Equipment::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        $data = [
            'fertilizers' => $fertilizers,
            'equipment' => $equipment,
        ];
        return view('client.search')->with('searchData', $data);
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