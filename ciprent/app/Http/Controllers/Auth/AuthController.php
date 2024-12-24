<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Core\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    function login()
    {
        $auth = session()->has('auth');
        if ($auth != NULL) {
            return redirect()->route('welcome')->withErrors(['please login first!']);
        }

        return view('home');
    }

    function index()
    {
        $auth = session()->has('auth');
        if ($auth == NULL) {
            return redirect()->route('home')->withErrors(['please login first!']);
        }

        $data = session('auth');
        return view('welcome', compact('data'));
    }

    function masterVehicle()
    {
        $auth = session()->has('auth');
        if ($auth == NULL) {
            return redirect()->route('home')->withErrors(['please login first!']);
        }

        $data = session('auth');
        return view('master.index', compact('data'));
    }

    function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'password' => 'required|string|min:6',
        ]);

        $user = self::getUserByUsername($request->username);

        if (Hash::check($request->password, $user->password)) {
            $request->session()->put('auth', $user);
            return redirect()->route('welcome')->withErrors(['Invalid credentials.']);
        }
        return redirect()->route('home')->withErrors(['Invalid credentials.']);
    }
}
