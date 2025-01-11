<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TourGalleryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tour_detail_id' => 'required|exists:tour_details,id', 
            'path' => 'required|image:jpeg,jpg,png,svg,webp',
        ]);

        $pathName = 'tour_picture_' . Carbon::now()->format("Y-m-d-h-i-s") . '.' . $request->file('path')->extension();
        $request->file('path')->move(base_path('public/upload/tour/'), $pathName);

        self::tourGallery()->create([
            'tour_detail_id' => $request->tour_detail_id,
            'path' => url('upload/tour') . '/' . $pathName,
            'path_name' => $pathName
        ]);

        return redirect()->route('tour-detail.index')->with('status', 'Gallery Has been Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
