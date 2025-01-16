<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Illuminate\Http\Request;

class SpaceDetailController extends BaseController
{
    function index()
    {
        $data = self::spaceDetail()
            ->with('addon', 'gallery', 'itenary')
            ->get();
        return view('master.space.detail.index', compact('data'));
    }

    function create()
    {
        $data = self::spaceAddon()->all();
        return view('master.space.detail.create', compact('data'));
    }

    function edit($id)
    {
        $data = self::spaceDetail()->with('addon')->find($id);
        $addonSpace = self::spaceAddon()->all();
        return view('master.space.detail.edit', compact('data', 'addonSpace'));
    }

    function store(Request $request)
    {
        $request->validate([
            'space_title' => 'required|string',
            'location' => 'required|string',
            'google_location' => 'required|string',
            'description' => 'required|string',
            'fasilities' => 'required|string',
            'min_pax' => 'required|integer',
            'max_pax' => 'required|integer',
            'available' => 'required|boolean',
            'days' => 'required|integer|max:30000',
            'price' => 'required|integer|min:6',
        ]);

        self::spaceDetail()->create([
            'space_title' => $request->space_title,
            'location' => $request->location,
            'google_location' => $request->google_location,
            'description' => $request->description,
            'fasilities' => $request->fasilities,
            'min_pax' => $request->min_pax,
            'max_pax' => $request->max_pax,
            'available' => $request->available,
            'days' => $request->days,
            'price' => $request->price
        ]);
        return redirect()->route('space-detail.index')->with('success', 'Data berhasil disimpan');
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'space_title' => 'required|string',
            'location' => 'required|string',
            'google_location' => 'required|string',
            'description' => 'required|string',
            'fasilities' => 'required|string',
            'min_pax' => 'required|integer',
            'max_pax' => 'required|integer',
            'available' => 'required|boolean',
            'days' => 'required|integer|max:30000',
            'price' => 'required|integer|min:6',
        ]);


        self::spaceDetail()->find($id)->update([
            'space_title' => $request->space_title,
            'location' => $request->location,
            'google_location' => $request->google_location,
            'description' => $request->description,
            'fasilities' => $request->fasilities,
            'min_pax' => $request->min_pax,
            'max_pax' => $request->max_pax,
            'available' => $request->available,
            'days' => $request->days,
            'price' => $request->price
        ]);
        return redirect()->route('space-detail.index')->with('success', 'Data berhasil diubah');
    }

    function destroy($id)
    {
        self::spaceDetail()->find($id)->delete();
        return redirect()->route('space-detail.index')->with('success', 'Data berhasil dihapus');
    }
}
