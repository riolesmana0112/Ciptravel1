<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;

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
            !isset($data) ? [] :$data, 
            !isset($data) ? 'no content available!' : 'content of pickup are founded!', 
            !isset($data) ? 404 : 200);
    }
}
