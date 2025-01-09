<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MasterVehicle extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = self::vehicle()->all();
        return self::validateAuth('master.vehicle.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return self::validateAuth('master.vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:255',
            'vehicle_name' => 'required|string|max:255',
            'vehicle_picture' => 'required|image:jpeg,jpg,png,svg,webp',
        ]);

        $pathName = 'vehicle_picture_' . Carbon::now()->format("Y-m-d-h-i-s") . '.' . $request->file('vehicle_picture')->extension();
        $request->file('vehicle_picture')->move(base_path('public/upload/vehicle/'), $pathName);
        self::vehicle()->create([
            'vehicle_type' => $request->vehicle_type,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_name' => $request->vehicle_name,
            'vehicle_picture' => url('upload/vehicle') . '/' . $pathName,
            'vehicle_path' => $pathName
        ]);

        return redirect()->route('vehicle.index')->with('status', 'Vehicle Has been Added!');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $data = self::vehicle()->findOrFail($id);
        return self::validateAuth('master.vehicle.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'vehicle_type' => 'required|string|max:255',
            'vehicle_number' => 'required|string|max:255',
            'vehicle_name' => 'required|string|max:255',
        ]);

        $data = self::vehicle()->findOrFail($id);

        if (isset($request->vehicle_picture)) {
            $request->validate([
                'vehicle_picture' => 'required|image:jpeg,jpg,png,svg,webp',
            ]);

            $request->file('vehicle_picture')->move(base_path('public/upload/vehicle/'), $data->vehicle_path);
        }

        $data->vehicle_type = $request->vehicle_type;
        $data->vehicle_number = $request->vehicle_number;
        $data->vehicle_name = $request->vehicle_name;
        $data->save();

        return redirect()->route('vehicle.index')->with('status', 'Vehicle has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = self::vehicle()->findOrFail($id);
        $path = public_path('upload/vehicle/' . $data->vehicle_path);

        File::delete($path);

        $data->delete();

        return redirect()->route('vehicle.index')->with('status', 'Vehicle has been deleted!');
    }
}
