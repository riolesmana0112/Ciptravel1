<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Itenary;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use App\Models\MasterVehicle as ModelsMasterVehicle;
use App\Models\MaterDrop;
use App\Models\MaterPickup;
use App\Models\PriceList;
use App\Models\MasterTour;
use App\Models\SpaceAddon;
use App\Models\SpaceAddonSpacePricelist;
use App\Models\SpaceDetail;
use App\Models\SpaceGallery;
use App\Models\SpaceItenary;
use App\Models\SpacePricelist;
use App\Models\TourDetail;
use App\Models\TourGallery;
use App\Models\TourProduct;

class BaseController extends Controller
{
    use Authenticatable;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    protected function validateAuth($page = '', $data = [])
    {
        $auth = session()->has('auth');
        if ($auth == NULL) {
            return redirect()->route('home')->withErrors(['please login first!']);
        }

        return view($page, compact('data'));
    }

    protected function getUserByUsername($username)
    {
        $user = self::user()->whereUsername($username)->first();
        $user->roles;
        return $user;
    }

    private function  user()
    {
        return new User;
    }

    protected function vehicle()
    {
        return new ModelsMasterVehicle;
    }

    protected function pickup()
    {
        return new MaterPickup;
    }

    protected function drop()
    {
        return new MaterDrop;
    }

    protected function itenary()
    {
        return new Itenary;
    }

    protected function tourGallery()
    {
        return new TourGallery;
    }

    protected function tourDetail()
    {
        return new TourDetail;
    }

    protected function masterTour()
    {
        return new MasterTour;
    }

    protected function tourProduct()
    {
        return new TourProduct;
    }

    protected function spaceDetail()
    {
        return new SpaceDetail;
    }

    protected function spaceitenary()
    {
        return new SpaceItenary;
    }

    protected function spaceGallery()
    {
        return new SpaceGallery;
    }

    protected function spaceAddon()
    {
        return new SpaceAddon;
    }

    protected function spacePriceList()
    {
        return new SpacePricelist;
    }

    protected function spacePricelistAddon()
    {
        return new SpaceAddonSpacePricelist;
    }

    protected function pricelist()
    {
        return new PriceList;
    }
}
