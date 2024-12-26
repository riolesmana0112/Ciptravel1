<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BaseController;

class ContentController extends BaseController
{
    function vehicle()
    {
        $data = self::pricelist()->with('vehicle')->get();
        return self::sendResponse($data, 'content of vehicles are founded!');
    }
}
