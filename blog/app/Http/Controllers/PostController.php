<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $html = Str::markdown ($post->body);
        $post ["html"] = $html;

        return view ("single_post", compact ("post"));
    }

    public function delete (Post $post)
    {
        $post->delete ();

        return redirect ()->route ("profile.show", auth ()->user ()->username)->with ("success", "Post deleted successfully");
    }

    public function edit (Post $post)
    {
        return view ("edit_post", compact ("post"));
    }

    public function update (Post $post, Request $request)
    {
        $incoming_fields = $request->validate ([
            "title" => "required",
            "body" => "required"
        ]);

        $incoming_fields ["title"] = strip_tags ($incoming_fields ["title"]);
        $incoming_fields ["body"] = strip_tags ($incoming_fields ["body"]);

        $post->update ($incoming_fields);

        return redirect ()->route ("posts.show", $post)->with ("success", "Post updated successfully");
    }

    public function search ($term)
    {
        $posts = Post::search ($term)->get ();
        $posts->load ("user:id,username,avatar");
        return $posts;
    }
}
