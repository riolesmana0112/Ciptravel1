<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpaceGalleryController extends BaseController
{
    public function store(Request $request)
    {
        $request->validate([
            'space_detail_id' => 'required|exists:space_details,id',
            'path' => 'required|image:jpeg,jpg,png,svg,webp',
        ]);

        $pathName = 'space_picture_' . Carbon::now()->format("Y-m-d-h-i-s") . '.' . $request->file('path')->extension();
        $request->file('path')->move(base_path('public/upload/space/'), $pathName);

        self::spaceGallery()->create([
            'space_detail_id' => $request->space_detail_id,
            'path' => url('upload/space') . '/' . $pathName,
            'path_name' => $pathName
        ]);

        return redirect()->route('space-detail.index')->with('status', 'Gallery Has been Added!');
    }
}
