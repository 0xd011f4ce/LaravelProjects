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

        $user = User::create ($incoming_fields);
        auth ()->login ($user);

        return redirect ()->route ("login")->with ("success", "You have succesfully registered!");
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
            return redirect ()->route ("home")->with ("success", "You have succesfully logged in!");
        }
        else
        {
            return redirect ()->route ("home")->with ("error", "Invalid login credentials!");
        }
    }

    public function logout ()
    {
        auth ()->logout ();

        return redirect ()->route ("home")->with ("success", "You have succesfully logged out!");
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

    public function show (User $user)
    {
        return view ("profile", compact ("user"));
    }
}
