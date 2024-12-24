<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use Authenticatable;

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
