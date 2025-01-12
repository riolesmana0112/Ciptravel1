<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Illuminate\Http\Request;

class ItenaryController extends BaseController
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required', 
        ]);

        self::itenary()->create([
            'description' => $request->description,
            'tour_detail_id' => $request->tour_detail_id,
        ]);

        return redirect()->route('tour-detail.index')->with('status', 'Itenary Has been Added!');
    }
}
