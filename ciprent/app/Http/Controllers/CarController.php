<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    /**
     * Display a listing of cars.
     */
    public function index()
    {
        $cars = Car::all();
        Log::info('All Cars Retrieved', ['cars' => $cars]); // Debug output
        return view('car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created car in the database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'car_image' => 'required|image:jpeg,jpg,png,svg,webp',
        ]);

        $pathName = 'car_image_' . Carbon::now()->format("Y-m-d-h-i-s") . '.' . $request->file('car_image')->extension();

        $request->file('car_image')->move(base_path('public/upload/car/'), $pathName);


        // Log the request data
        Log::info('Store Request Data:', $request->all());

        // Simpan data ke database
        Car::create([
            'kendaraan' => $request->kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'car_image' => url('upload/car') . '/' . $pathName,
            'path' => $pathName
        ]);

        return redirect()->route('car.index')->with('success', 'Mobil berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified car.
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id); // Gunakan findOrFail untuk memastikan data ditemukan
        return view('car.edit', compact('car'));
    }

    /**
     * Update the specified car in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input data
        $validated = $request->validate([
            'status' => 'required',
            'condition' => 'required',
            'keterangan' => 'nullable|string',
            'verified' => 'boolean',
        ]);

        // Cari mobil berdasarkan ID
        $car = Car::findOrFail($id);

        // Perbarui data mobil
        $car->update([
            'status' => $request->input('status'),
            'condition' => $request->input('condition'),
            'keterangan' => $request->input('keterangan'),
            'verified' => $request->input('verified') ? 1 : 0,
        ]);

        // Redirect kembali ke halaman daftar mobil dengan pesan sukses
        return redirect()->route('car.index')->with('success', 'Car details updated successfully');
    }


    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('car.index');
    }

    /**
     * Delete the specified car from storage.
     */


    /**
     * Update the status of multiple cars.
     */
    public function updateStatus(Request $request)
    {
        foreach ($request->units as $id => $unit) {
            $car = Car::findOrFail($id); // Gunakan findOrFail untuk memastikan data ditemukan
            $car->unit = $unit;
            $car->condition = $request->conditions[$id];
            $car->keterangan = $request->keterangan[$id] ?? null;
            $car->verified = isset($request->verification[$id]);
            $car->save();
        }

        return redirect()->route('car.index')->with('success', 'Status mobil berhasil diperbarui!');
    }

    /**
     * Display the maintenance view.
     */
    public function maintenance()
    {
        return view('car.maintenance');
    }

    /**
     * Display the daily report view.
     */
    public function dailyReport()
    {
        return view('car.dailyreport');
    }

    /**
     * Display the car status view.
     */
    public function carStatus()
    {
        return view('car.car-status');
    }

    /**
     * Save car updates and redirect to welcome page.
     */
    /**
     * Save car updates and redirect to welcome page.
     */
    public function saveAndRedirect(Request $request)
    {
        // Debugging the incoming request data
        dd($request->all());  // This will show all data being sent in the request

        // Validasi Input
        $request->validate([
            'status.*' => 'required|string|in:Available,Busy',
            'condition.*' => 'required|string|in:Good,Poor',
            'keterangan.*' => 'nullable|string|max:255',
            'verification.*' => 'nullable|boolean',
        ]);

        // Loop untuk menyimpan data mobil
        foreach ($request->status as $id => $status) {
            // Ensure the ID is valid before proceeding
            if (!$car = Car::find($id)) {
                // Log error if car is not found
                Log::error("Car not found for ID: $id");

                // Redirect with error message
                return redirect()->back()->withErrors(["Car with ID $id not found."]);
            }

            // Update car data
            $car->status = $status;
            $car->condition = $request->condition[$id] ?? 'Good'; // Default 'Good' if not provided
            $car->keterangan = $request->keterangan[$id] ?? null;
            $car->verified = isset($request->verification[$id]) && $request->verification[$id] == 1 ? 1 : 0;
            $car->save();
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'Car details saved successfully.');
    }
}
