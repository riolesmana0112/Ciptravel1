<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use Carbon\Carbon; // Untuk manipulasi tanggal

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::all(); // Ambil semua data maintenance
        return view('maintenance.index', compact('maintenances'));
    }

    public function create()
    {
        $nomorRekeningList = [
            '2330828440 - Ando',
            '7940359133 - AA Wiguna'
        ]; // Daftar nomor rekening

        return view('maintenance.create', compact('nomorRekeningList'));
    }

    public function store(Request $request)
    {
        // Validasi data request
        $request->validate([
            'nama_requestor' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:100',
            'plat_nomor' => 'required|string|max:50',
            'jenis_maintenance' => 'required|string|max:100',
            'biaya' => 'required|numeric',
            'vendor' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:30|regex:/^[0-9]{4,10}\s-\s[\w\s]+$/', // Validasi format nomor rekening
        ]);

        // Simpan data maintenance ke database
        $maintenance = new Maintenance();
        $maintenance->tanggal = $request->tanggal ?? Carbon::now(); // Set tanggal sekarang jika kosong
        $maintenance->nama_requestor = $request->nama_requestor;
        $maintenance->jenis_kendaraan = $request->jenis_kendaraan;
        $maintenance->plat_nomor = $request->plat_nomor;
        $maintenance->jenis_maintenance = $request->jenis_maintenance;
        $maintenance->biaya = $request->biaya;
        $maintenance->vendor = $request->vendor;
        $maintenance->nomor_rekening = $request->nomor_rekening;
        $maintenance->keterangan = $request->keterangan ?? null; // Default jika kosong
        $maintenance->approval_status = $request->has('approval_status');
        $maintenance->save();

        // Redirect ke halaman index maintenance
        return redirect()->route('maintenance.index')->with('success', 'Maintenance created successfully.');
    }

    /**
     * Tampilkan form edit untuk maintenance tertentu.
     */
    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id); // Ambil data berdasarkan ID
        $nomorRekeningList = [
            '2330828440 - Ando',
            '7940359133 - AA Wiguna'
        ]; // Daftar nomor rekening

        return view('maintenance.edit', compact('maintenance', 'nomorRekeningList'));
    }

    /**
     * Perbarui data maintenance di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi data request
        $request->validate([
            'tanggal' => 'required|date',
            'nama_requestor' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:100',
            'plat_nomor' => 'required|string|max:50',
            'jenis_maintenance' => 'required|string|max:100',
            'biaya' => 'required|numeric',
            'vendor' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:30|regex:/^[0-9]{4,10}\s-\s[\w\s]+$/', // Validasi format nomor rekening
        ]);

        // Perbarui data maintenance di database
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->tanggal = $request->tanggal;
        $maintenance->nama_requestor = $request->nama_requestor;
        $maintenance->jenis_kendaraan = $request->jenis_kendaraan;
        $maintenance->plat_nomor = $request->plat_nomor;
        $maintenance->jenis_maintenance = $request->jenis_maintenance;
        $maintenance->biaya = $request->biaya;
        $maintenance->vendor = $request->vendor;
        $maintenance->nomor_rekening = $request->nomor_rekening;
        $maintenance->keterangan = $request->keterangan ?? null;
        $maintenance->approval_status = $request->has('approval_status');
        $maintenance->save();

        // Redirect ke halaman index maintenance
        return redirect()->route('maintenance.index')->with('success', 'Maintenance updated successfully.');
    }

    /**
     * Hapus maintenance dari database.
     */
    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        // Redirect ke halaman index maintenance
        return redirect()->route('maintenance.index')->with('success', 'Maintenance deleted successfully.');
    }
}
