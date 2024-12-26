<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Illuminate\Http\Request;

class MasterDropController extends BaseController
{
    public function index()
    {
        $data = self::drop()->all();
        return self::validateAuth('master.drop.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return self::validateAuth('master.drop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'drop_name' => 'required|string|max:255',
        ]);

        self::drop()->create([
            'drop_name' => $request->drop_name,
        ]);

        return redirect()->route('drop.index')->with('status', 'drop Has been Added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = self::drop()->findOrFail($id);
        return self::validateAuth('master.drop.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'drop_name' => 'required|string|max:255',
        ]);

        $data = self::drop()->findOrFail($id);
        $data->drop_name = $request->drop_name;
        $data->save();

        return redirect()->route('drop.index')->with('status', 'drop has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = self::drop()->findOrFail($id);
        $data->delete();
        return redirect()->route('drop.index')->with('status', 'drop has been deleted!');
    }
}
