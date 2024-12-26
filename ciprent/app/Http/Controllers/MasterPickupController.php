<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Illuminate\Http\Request;

class MasterPickupController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = self::pickup()->all();
        return self::validateAuth('master.pickup.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return self::validateAuth('master.pickup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pickup_name' => 'required|string|max:255',
        ]);

        self::pickup()->create([
            'pickup_name' => $request->pickup_name,
        ]);

        return redirect()->route('pickup.index')->with('status', 'Pickup Has been Added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = self::pickup()->findOrFail($id);
        return self::validateAuth('master.pickup.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pickup_name' => 'required|string|max:255',
        ]);

        $data = self::pickup()->findOrFail($id);
        $data->pickup_name = $request->pickup_name;
        $data->save();

        return redirect()->route('pickup.index')->with('status', 'Pickup has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = self::pickup()->findOrFail($id);
        $data->delete();
        return redirect()->route('pickup.index')->with('status', 'Pickup has been deleted!');
    }
}
