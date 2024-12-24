<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

// User related routes
Route::get ('/', [ UserController::class, "homepage" ])->name ("home");
Route::post ("/register", [ UserController::class, "register" ])->name ("register")->middleware ("guest");
Route::post ("/login", [ UserController::class, "login" ])->name ("login")->middleware ("guest");
Route::post ("/logout", [ UserController::class, "logout" ])->name ("logout")->middleware ("auth");

// Blog related routes
Route::get ("/post/create", [ PostController::class, "create" ])->name ("posts.create")->middleware ("mbli");
Route::post ("/post/create", [ PostController::class, "store" ])->middleware ("mbli");
Route::get ("/post/{post}", [ PostController::class, "show" ])->name ("posts.show");
Route::delete ("/post/{post}", [ PostController::class, "delete" ])->name ("posts.delete")->middleware ("can:delete,post");
Route::get ("/post/{post}/edit", [ PostController::class, "edit" ])->name ("posts.edit")->middleware ("can:update,post");
Route::put ("/post/{post}/edit", [ PostController::class, "update" ])->name ("posts.update")->middleware ("can:update,post");

// Profile related routes
Route::get ("/profile/{user:username}", [ UserController::class, "show" ])->name ("profile.show");

Route::get ("/admin", function () {
    return "so you're cool dwag";
})->middleware ("can:visit_admin_pages");
