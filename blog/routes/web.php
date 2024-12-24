<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get ('/', [ UserController::class, "homepage" ])->name ("home");

Route::post ("/register", [ UserController::class, "register" ])->name ("register");
Route::post ("/login", [ UserController::class, "login" ])->name ("login");
Route::post ("/logout", [ UserController::class, "logout" ])->name ("logout");
