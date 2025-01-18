<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Illuminate\Http\Request;

class TourProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = self::tourProduct()->with('type', 'detail')->get();
        return view('master.tour-product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = self::masterTour()->select('id', 'product_name', 'product_type')->get();
        $detail = self::tourDetail()->select('id', 'tour_title')->get();
        return view('master.tour-product.create', compact('type', 'detail'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'master_tour_id' => 'required|exists:master_tours,id',
            'tour_detail_id' => 'required|exists:tour_details,id',
        ]);

        self::tourProduct()->create([
            'master_tour_id' => $request->master_tour_id,
            'tour_detail_id' => $request->tour_detail_id,
        ]);

        return redirect()->route('tour-product.index')->with('success', 'Data Successfully Created');
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
        $data = self::tourProduct()->find($id);
        $type = self::masterTour()->select('id', 'product_name', 'product_type')->get();
        $detail = self::tourDetail()->select('id', 'tour_title')->get();
        return view('master.tour-product.edit', compact('data', 'type', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'master_tour_id' => 'required|exists:master_tours,id',
            'tour_detail_id' => 'required|exists:tour_details,id',
        ]);

        self::tourProduct()->find($id)->update([
            'master_tour_id' => $request->master_tour_id,
            'tour_detail_id' => $request->tour_detail_id,
        ]);

        return redirect()->route('tour-product.index')->with('success', 'Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        self::tourProduct()->find($id)->delete();
        return redirect()->route('tour-product.index')->with('success', 'Data Successfully Deleted');
    }
}
