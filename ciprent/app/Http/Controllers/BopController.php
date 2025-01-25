<?php

namespace App\Http\Controllers;

use App\Models\Bop;
use Illuminate\Http\Request;

class BopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bops = Bop::all();
        return view('bop.index', compact('bops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'tanggal' => 'required|date',
            'nama_driver' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'keberangkatan' => 'nullable|date',
            'kepulangan' => 'nullable|date',
            'harga' => 'required|string', // Pastikan ini disimpan sebagai string (dengan format Rupiah)
            'nomor_rekening' => 'nullable|string|max:255',
            'approval_status' => 'nullable|boolean', // Validasi checkbox dengan benar
        ]);

        // Simpan data ke database
        Bop::create([
            'tanggal' => $request->tanggal,
            'nama_driver' => $request->nama_driver,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'tujuan' => $request->tujuan,
            'keberangkatan' => $request->keberangkatan,
            'kepulangan' => $request->kepulangan,
            'harga' => preg_replace('/[^0-9]/', '', $request->harga), // Hilangkan format Rupiah
            'nomor_rekening' => $request->nomor_rekening,
            'approval_status' => $request->approval_status, // Ubah checkbox menjadi boolean
        ]);

        return redirect()->route('bop.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bop = Bop::findOrFail($id); // Ambil data BOP berdasarkan ID
        return view('bop.edit', compact('bop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bop = Bop::findOrFail($id); // Pastikan data ditemukan

        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nama_driver' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'keberangkatan' => 'required|date',
            'kepulangan' => 'required|date|after:keberangkatan', // Pastikan kepulangan setelah keberangkatan
            'harga' => 'required|regex:/^\d+$/', // Hanya angka yang diperbolehkan untuk biaya
            'approval_status' => 'nullable|boolean',
            'nomor_rekening' => 'required|string|max:255',
        ]);

        // Update data BOP
        $bop->update([
            'tanggal' => $validated['tanggal'],
            'nama_driver' => $validated['nama_driver'],
            'jenis_kendaraan' => $validated['jenis_kendaraan'],
            'plat_nomor' => $validated['plat_nomor'],
            'tujuan' => $validated['tujuan'],
            'keberangkatan' => $validated['keberangkatan'],
            'kepulangan' => $validated['kepulangan'],
            'harga' => str_replace('.', '', $validated['harga']), // Hilangkan pemisah ribuan jika ada
            'approval_status' => $request->has('approval_status') ? 1 : 0, // Ubah checkbox menjadi boolean
            'nomor_rekening' => $validated['nomor_rekening'],
        ]);

        return redirect()->route('bop.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bop = Bop::findOrFail($id); // Temukan data berdasarkan ID
        $bop->delete(); // Hapus data
    
        return redirect()->route('bop.index')->with('success', 'Data berhasil dihapus.');
    }    
}