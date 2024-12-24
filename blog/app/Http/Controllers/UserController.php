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
}
