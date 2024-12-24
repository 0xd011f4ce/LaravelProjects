<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register (Request $request)
    {
        $incoming_fields = $request->validate ([
            "username" => "required|min:4|max:32|unique:users",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|max:32|confirmed",
        ]);

        User::create ($incoming_fields);
    }

    public function login (Request $request)
    {
        $incoming_fields = $request->validate ([
            "loginusername" => "required",
            "loginpassword" => "required",
        ]);

        if (auth ()->attempt (["username" => $incoming_fields["loginusername"], "password" => $incoming_fields["loginpassword"]]))
        {
            $request->session ()->regenerate ();
            return "Congrats!!!";
        }
        else
        {
            return "Sorry";
        }
    }

    public function homepage ()
    {
        if (auth ()->check ())
        {
            return view ("feed");
        }
        else
        {
            return view ("home");
        }
    }
}
