<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;
use Illuminate\Http\Request;

class ContentController extends BaseController
{
    function listVehicle()
    {
        $data = self::vehicle()->all();
        return self::sendResponse($data, 'content of vehicles are founded!');
    }

    function pickupData()
    {
        $data = self::pickup()->all();
        return self::sendResponse($data, 'content of pickup are founded!');
    }

    function dropData()
    {
        $data = self::drop()->all();
        return self::sendResponse($data, 'content of pickup are founded!');
    }

    function getPrice($vehicleId, $pickupId, $dropId)
    {
        $data = self::pricelist()->where([
            ['vehicle_id', '=', $vehicleId],
            ['pickup_id', '=', $pickupId],
            ['driop_id', '=', $dropId]
        ])
            ->with('vehicle', 'pickup_point', 'drop_point')
            ->first();

        return self::sendResponse(
            !isset($data) ? [] : $data,
            !isset($data) ? 'no content available!' : 'content of pickup are founded!',
            !isset($data) ? 404 : 200
        );
    }

    function getTourData()
    {
        $data = self::tourDetail()->with('type', 'gallery', 'itenary')->get();
        return self::sendResponse($data, 'content of tour detail are founded!');
    }

    function getTourType()
    {
        $data = self::masterTour()->get();
        return self::sendResponse($data, 'content of tour type are founded!');
    }

    function getTourProduct($id)
    {
        $data = self::tourDetail()->with('type', 'gallery', 'itenary')->findOrFail($id);
        return self::sendResponse(
            $data,
            'content of tour product are founded!'
        );
    }

    function getSpaceData()
    {
        $data = self::spaceDetail()->with('gallery', 'itenary')->get();
        return self::sendResponse($data, 'content of space are founded!');
    }

    function getSpaceAddon()
    {
        $data = self::spaceAddon()->get();
        return self::sendResponse($data, 'content of space addon are founded!');
    }

    public function getSpaceProduct($space_detail_id, $addons)
    {
        $addonsArray = explode(',', $addons);

        $query = self::spacePricelist()->where('space_detail_id', '=', $space_detail_id);

        if (!empty($addonsArray)) {
            $query->whereHas('addon', function ($addon) use ($addonsArray) {
                $addon->whereIn('id', $addonsArray);
            }, '=', count($addonsArray));
        }

        $priceList = $query->with('detail', 'addon')->first();

        return self::sendResponse(
            $priceList ? $priceList : [],
            $priceList ? 'content of space product are founded!' : 'no content available!',
            $priceList ? 200 : 404
        );
    }
}
