<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store (User $user)
    {
        // you cannot follow yourself
        if ($user->id === auth ()->user ()->id)
        {
            return back ()->with ("error", "You cannot follow yourself!");
        }

        // you cannot follow someone you're already following
        $exist_check = Follow::where ([["user_id", "=", auth ()->user ()->id], ["following_id", "=", $user->id]])->count ();
        if ($exist_check > 0)
        {
            return back ()->with ("error", "You're already following this user!");
        }

        $new_follow = new Follow;
        $new_follow->user_id = auth ()->id (); // user creating follow
        $new_follow->following_id = $user->id;
        $new_follow->save ();

        return back ()->with ("success", "You're now following " . $user->username . "!");
    }

    public function destroy (User $user)
    {

    }
}
