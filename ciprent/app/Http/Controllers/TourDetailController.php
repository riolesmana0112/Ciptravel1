<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Core\BaseController;

use Illuminate\Http\Request;

class TourDetailController extends BaseController
{
    function index()
    {
        $data = self::tourDetail()
        ->with('gallery', 'tour', 'itenary')
        ->get();
        // return $data;
        return view('master.tour.detail.index', compact('data'));
    }

    function create()
    {
        $data = self::masterTour()->all();
        return view('master.tour.detail.create', compact('data'));
    }

    function edit($id)
    {
        $data = self::tourDetail()->with('masterTour')->find($id);
        $tourType = self::masterTour()->all();
        return view('master.tour.detail.edit', compact('data', 'tourType'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'tour_title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'pickup' => 'required|string',
            'pickup_name' => 'required|string',
            'map_location' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer|min:6',
            'facilities' => 'required|string',
        ]);

        $days = (strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24);

        self::tourDetail()->find($id)->update([
            'tour_title' => $request->tour_title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'pickup' => $request->pickup,
            'pickup_name' => $request->pickup_name,
            'map_location' => $request->map_location,
            'description' => $request->description,
            'fasilities' => $request->facilities,
            'price' => $request->price,
            'master_tour_id' => $request->tour_id,
            'days' => $days
        ]);
        return redirect()->route('tour-detail.index')->with('success', 'Data berhasil diubah');
    }

    function store(Request $request)
    {
        $request->validate([
            'tour_title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'pickup' => 'required|string',
            'pickup_name' => 'required|string',
            'map_location' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer|min:6',
            'facilities' => 'required|string',
        ]);

        $days = (strtotime($request->end_date) - strtotime($request->start_date)) / (60 * 60 * 24);


        self::tourDetail()->create([
            'tour_title' => $request->tour_title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'pickup' => $request->pickup,
            'pickup_name' => $request->pickup_name,
            'map_location' => $request->map_location,
            'description' => $request->description,
            'fasilities' => $request->facilities,
            'price' => $request->price,
            'master_tour_id' => $request->tour_id,
            'days' => $days
        ]);
        return redirect()->route('tour-detail.index')->with('success', 'Data berhasil disimpan');
    }
}