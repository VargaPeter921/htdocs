<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return view('home');
});

Route::get('/expertLekeres', function() {
    return view('expertLekeres');
});

Route::get('/bolt', function() {
    return view('bolt');
});

/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';
