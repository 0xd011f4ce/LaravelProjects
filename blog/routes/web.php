<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "<h1>Home</h1><a href='/about'>About</a>";
});

Route::get ("/about", function () {
    return "<h1>About us</h1><a href='/'>Home</a>";
});