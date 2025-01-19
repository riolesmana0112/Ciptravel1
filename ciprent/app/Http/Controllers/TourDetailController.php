<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Core\BaseController;

use Illuminate\Http\Request;

class TourDetailController extends BaseController
{
    function index()
    {
        $data = self::tourDetail()
        ->with('type', 'gallery', 'itenary')
        ->get();

        return view('master.tour.detail.index', compact('data'));
    }

    function create()
    {
        $type = self::masterTour()->select('id', 'product_name', 'product_type')->get();
        return view('master.tour.detail.create', compact('type'));
    }

    function edit($id)
    {
        $type = self::masterTour()->select('id', 'product_name', 'product_type')->get();
        $data = self::tourDetail()->with('type', 'gallery', 'itenary')->find($id);
        return view('master.tour.detail.edit', compact('data', 'type'));
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
            'master_tour_id' => 'required|exists:master_tours,id',
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
            'days' => $days,
            'master_tour_id' => $request->master_tour_id
        ]);
        return redirect()->route('tour-detail.index')->with('success', 'Data Successfully Updated');
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
            'master_tour_id' => 'required|exists:master_tours,id',
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
            'days' => $days,
            'master_tour_id' => $request->master_tour_id
        ]);
        return redirect()->route('tour-detail.index')->with('success', 'Data Successfully Created');
    }

    function destroy($id)
    {
        self::tourDetail()->find($id)->delete();
        return redirect()->route('tour-detail.index')->with('success', 'Data Successfully Deleted');
    }
}