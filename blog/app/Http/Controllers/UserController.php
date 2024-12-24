<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    private function get_shared_data (User $user)
    {
        $following = 0;

        if (auth ()->check ())
        {
            $following = Follow::where ([
                ["user_id", "=", auth ()->user ()->id],
                ["following_id", "=", $user->id]
            ])->count () > 0;
        }

        return [
            "following" => $following
        ];
    }

    public function register (Request $request)
    {
        $incoming_fields = $request->validate ([
            "username" => "required|min:4|max:32|unique:users",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|max:32|confirmed",
        ]);

        $user = User::create ($incoming_fields);
        auth ()->login ($user);

        return redirect ()->route ("home")->with ("success", "You have succesfully registered!");
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
        $following = $this->get_shared_data ($user) ["following"];

        return view ("profile", compact ("user", "following"));
    }

    public function manage_avatar ()
    {
        return view ("avatar-form");
    }

    public function update_avatar (Request $request)
    {
        $request->validate ([
            "avatar" => "required|image|max:4096",
        ]);

        $user = auth ()->user ();
        $fname = $user->id . "-" . uniqid () . ".jpg";

        $manager = new ImageManager (new Driver ());
        $image = $manager->read ($request->file ("avatar"));
        $image_data = $image->cover (120, 120)->toJpeg ();
        Storage::disk ("public")->put ("avatars/" . $fname, $image_data);

        $old_avatar = $user->avatar;

        $user->avatar = $fname;
        $user->save ();

        if ($old_avatar != "/fallback-avatar.jpg")
        {
            Storage::disk ("public")->delete (str_replace ("/storage/", "", $old_avatar));
        }

        return back ()->with ("success", "lookin hella fresh bro");
    }

    public function following (User $user)
    {
        $following = $this->get_shared_data ($user) ["following"];

        return view ("profile_following", compact ("user", "following"));
    }

    public function followers (User $user)
    {
        $following = $this->get_shared_data ($user) ["following"];

        return view ("profile_followers", compact ("user", "following"));
    }
}
