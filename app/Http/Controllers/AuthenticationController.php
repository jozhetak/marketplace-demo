<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthenticationController extends Controller
{
    //
    public function logoutAPI()
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
        }

        return response("logged out", 200);
    }
}
