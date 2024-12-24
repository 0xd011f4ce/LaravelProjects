<?php

use App\Events\ChatMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

// User related routes
Route::get ('/', [ UserController::class, "homepage" ])->name ("home");
Route::post ("/register", [ UserController::class, "register" ])->name ("register")->middleware ("guest");
Route::post ("/login", [ UserController::class, "login" ])->name ("login")->middleware ("guest");
Route::post ("/logout", [ UserController::class, "logout" ])->name ("logout")->middleware ("mbli");
Route::get ("/manage-avatar", [ UserController::class, "manage_avatar" ])->name ("manage_avatar")->middleware ("mbli");
Route::post ("/manage-avatar", [ UserController::class, "update_avatar" ])->middleware ("mbli");

// Blog related routes
Route::get ("/post/create", [ PostController::class, "create" ])->name ("posts.create")->middleware ("mbli");
Route::post ("/post/create", [ PostController::class, "store" ])->middleware ("mbli");
Route::get ("/post/{post}", [ PostController::class, "show" ])->name ("posts.show");
Route::delete ("/post/{post}", [ PostController::class, "delete" ])->name ("posts.delete")->middleware ("can:delete,post");
Route::get ("/post/{post}/edit", [ PostController::class, "edit" ])->name ("posts.edit")->middleware ("can:update,post");
Route::put ("/post/{post}/edit", [ PostController::class, "update" ])->name ("posts.update")->middleware ("can:update,post");

Route::get ("/search/{term}", [ PostController::class, "search" ])->name ("posts.search");

// follow related routes
Route::post ("/follow/{user:username}", [ FollowController::class, "store" ])->name ("follow.store")->middleware ("mbli");
Route::delete ("/follow/{user:username}", [ FollowController::class, "destroy" ])->name ("follow.destroy")->middleware ("mbli");

// Profile related routes
Route::get ("/profile/{user:username}", [ UserController::class, "show" ])->name ("profile.show");
Route::get ("/profile/{user:username}/followers", [ UserController::class, "followers" ])->name ("profile.followers");
Route::get ("/profile/{user:username}/following", [ UserController::class, "following" ])->name ("profile.following");

// chat routes
Route::post ("/send-chat-message", function (Request $request) {
    $fields = $request->validate ([
        "message" => "required",
    ]);

    if (!trim (strip_tags ($fields["message"])))
    {
        return response ()->noContent ();
    }

    broadcast (new ChatMessage ([
        "username" => auth ()->user ()->username,
        "message" => strip_tags ($fields["message"]),
        "avatar" => auth ()->user ()->avatar
    ]))->toOthers ();

    return response ()->noContent ();
})->middleware ("mbli");

Route::get ("/admin", function () {
    return "so you're cool dwag";
})->middleware ("can:visit_admin_pages");
