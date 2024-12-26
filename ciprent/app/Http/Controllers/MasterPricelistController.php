<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use App\Models\MasterVehicle;
use App\Models\MaterDrop;
use App\Models\MaterPickup;
use App\Models\PriceList;
use Illuminate\Http\Request;

class MasterPricelistController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = self::pricelist()->with('vehicle', 'pickup_point', 'drop_point')->get();
        return self::validateAuth('master.pricelist.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $auth = session()->has('auth');
        if ($auth == NULL) {
            return redirect()->route('home')->withErrors(['please login first!']);
        }
        $vehicle = MasterVehicle::select('id', 'vehicle_type', 'vehicle_name')->get();
        $pickup = MaterPickup::select('id', 'pickup_name')->get();
        $drop = MaterDrop::select('id', 'drop_name')->get();
        return view('master.pricelist.create', compact('vehicle', 'pickup', 'drop'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|string|exists:master_vehicles,id',
            'pickup_id' => 'required|string|exists:mater_pickups,id',
            'drop_id' => 'required|string|exists:mater_drops,id',
            'price' => 'required|integer|min:6',
            'charge_per_hour' => 'required|integer|min:6',
            'description' => 'required|string'
        ]);

        self::pricelist()->create([
            'vehicle_id' => $request->vehicle_id,
            'pickup_id' => $request->pickup_id,
            'driop_id' => $request->drop_id,
            'price' => $request->price,
            'charge_per_hour' => $request->charge_per_hour,
            'description' => $request->description
        ]);

        return redirect()->route('pricelist.index')->with('status', 'Price List Has been Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
        $data = self::pricelist()->findOrFail($id);
        $data->delete();
        return redirect()->route('pricelist.index')->with('status', 'Price List has been deleted!');
    }
}
