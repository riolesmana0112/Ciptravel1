<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        // Menampilkan data driver
        $drivers = Driver::all();
        return view('driver.index', compact('drivers'));
    }

    public function create()
    {
        // Form untuk tambah data
        return view('driver.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
            'mobil' => 'required|string',
            'plat_nomor' => 'required|string',
            'jemput' => 'required|string',
            'drop_off' => 'required|string',
            'berangkat' => 'required|date',
            'pulang' => 'required|date',
            'tujuan' => 'required|string',
        ]);

        // Simpan data ke database
        Driver::create($request->all());

        return redirect()->route('driver.index')->with('success', 'Data driver berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Form untuk edit data
        $driver = Driver::findOrFail($id);
        return view('driver.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
            'mobil' => 'required|string',
            'plat_nomor' => 'required|string',
            'jemput' => 'required|string',
            'drop_off' => 'required|string',
            'berangkat' => 'required|date',
            'pulang' => 'required|date',
            'tujuan' => 'required|string',
        ]);

        // Update data di database
        $driver = Driver::findOrFail($id);
        $driver->update($request->all());

        return redirect()->route('driver.index')->with('success', 'Data driver berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Hapus data
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return redirect()->route('driver.index')->with('success', 'Data driver berhasil dihapus!');
    }
}