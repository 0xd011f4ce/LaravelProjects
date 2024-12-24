<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create (Request $request)
    {
        return view ("create_post");
    }

    public function store (Request $request)
    {
        $incoming_fields = $request->validate ([
            "title" => "required",
            "body" => "required"
        ]);

        $incoming_fields ["title"] = strip_tags ($incoming_fields ["title"]);
        $incoming_fields ["body"] = strip_tags ($incoming_fields ["body"]);
        $incoming_fields ["user_id"] = auth ()->id ();

        $post = Post::create ($incoming_fields);

        return redirect ()->route ("posts.show", $post)->with ("success", "Post created successfully");
    }

    public function show (Request $request, Post $post)
    {
        return view ("single_post", compact ("post"));
    }
}
