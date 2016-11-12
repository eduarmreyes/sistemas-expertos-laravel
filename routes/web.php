<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Profile routes
Route::post("/profile/set", "Controller@setProfile");

// Menu routes
Route::get("/menu/get", "HomeController@getMenu");

// Persona routes
Route::get("/personas/show", "PersonaController@show");
Route::get("/personas/getPersonas", "PersonaController@getPersonas");
Route::post("/personas/savePersonas", "PersonaController@savePersonas");
