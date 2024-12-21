<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use Authenticatable;

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
