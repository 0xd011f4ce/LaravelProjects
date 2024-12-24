<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExampleController;
use App\Http\Controllers\UserController;

Route::get ('/', [ UserController::class, "homepage" ]);
Route::get ("/about", [ ExampleController::class, "aboutpage" ]);

Route::post ("/register", [ UserController::class, "register" ])->name ("register");
Route::post ("/login", [ UserController::class, "login" ])->name ("login");
