<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

// User related routes
Route::get ('/', [ UserController::class, "homepage" ])->name ("home");
Route::post ("/register", [ UserController::class, "register" ])->name ("register");
Route::post ("/login", [ UserController::class, "login" ])->name ("login");
Route::post ("/logout", [ UserController::class, "logout" ])->name ("logout");

// Blog related routes
Route::get ("/post/create", [ PostController::class, "create" ])->name ("posts.create");
Route::post ("/post/create", [ PostController::class, "store" ]);
