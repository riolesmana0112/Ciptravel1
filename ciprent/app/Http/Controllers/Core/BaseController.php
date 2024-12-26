<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use App\Models\MasterVehicle as ModelsMasterVehicle;
use App\Models\PriceList;

class BaseController extends Controller
{
    use Authenticatable;

    protected function pricelist()
    {
        return new PriceList;
    }

    protected function vehicle()
    {
        return new ModelsMasterVehicle;
    }

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
}
