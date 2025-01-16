<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Illuminate\Http\Request;

class SpaceItenaryController extends BaseController
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        self::spaceItenary()->create([
            'description' => $request->description,
            'space_detail_id' => $request->space_detail_id,
        ]);

        return redirect()->route('space-detail.index')->with('status', 'Itenary Has been Added!');
    }
}
