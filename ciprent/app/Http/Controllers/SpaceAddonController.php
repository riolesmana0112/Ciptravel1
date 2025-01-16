<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;

use Illuminate\Http\Request;

class SpaceAddonController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = self::spaceAddon()->all();
        return self::validateAuth('master.space.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return self::validateAuth('master.space.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'addon_title' => 'required|string|max:255',
            'price' => 'required|integer|min:6',
        ]);

        self::spaceAddon()->create([
            'addon_title' => $request->addon_title,
            'price' => $request->price
        ]);

        return redirect()->route('space-addon.index')->with('status', 'Master Tour Has been Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function edit(string $id)
    {
        $data = self::spaceAddon()->find($id);
        return self::validateAuth('master.space.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'addon_title' => 'required|string|max:255',
            'price' => 'required|integer|min:6',
        ]);

        self::spaceAddon()->find($id)->update([
            'addon_title' => $request->addon_title,
            'price' => $request->price
        ]);

        return redirect()->route('space-addon.index')->with('status', 'Space Addon Has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        self::spaceAddon()->find($id)->delete();
        return redirect()->route('space-addon.index')->with('status', 'Master Tour Has been Deleted!');
    }
}
