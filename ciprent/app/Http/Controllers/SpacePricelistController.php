<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Illuminate\Http\Request;

class SpacePricelistController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = self::spacePriceList()->with("detail", "addon")->get();
        return view('master.space-pricelist.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detail = self::spaceDetail()->select('id', 'space_title', 'location')->get();
        $addon = self::spaceAddon()->select('id', 'addon_title', 'price')->get();
        return view('master.space-pricelist.create', compact('detail', 'addon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'space_detail_id' => 'required|exists:space_details,id',
            'addons' => 'nullable|array',
        ]);
        
        $detail = self::spaceDetail()->find($request->space_detail_id);

        $addons = $request->addons ? self::spaceAddon()->whereIn('id', $request->addons)->get() : collect([]);

        $addonsPrice = $addons->sum('price');

        $totalPrice = $detail->price + $addonsPrice;

        $priceList = self::spacePriceList()->create([
            'space_detail_id' => $request->space_detail_id,
            'price' => $totalPrice,
        ]);

        if ($addons->isNotEmpty()) {
            $priceList->addon()->sync($request->addons);
        }

        return redirect()->route('space-pricelist.index')->with('success', 'Data berhasil disimpan');
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
        $pricelist = self::spacePriceList()->with("detail", "addon")->find($id);
        $detail = self::spaceDetail()->select('id', 'space_title', 'location')->get();
        $addon = self::spaceAddon()->select('id', 'addon_title', 'price')->get();
        return view('master.space-pricelist.edit', compact('pricelist', 'detail', 'addon'));
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
        self::spacePriceList()->find($id)->delete();
        return redirect()->route('space-pricelist.index')->with('success', 'Data berhasil dihapus');
    }
}
