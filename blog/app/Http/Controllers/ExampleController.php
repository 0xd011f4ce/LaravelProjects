<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homepage ()
    {
        // imagine we loaded data from the database
        $ourname = "Lain";
        $animals = [
            "Meowsalot",
            "Barksalot",
            "Purrsloud"
        ];

        return view ("home", [
            "name" => $ourname,
            "all_animals" => $animals
        ]);
    }

    public function aboutpage ()
    {
        return view ("single_post");
    }
}
