<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('hello', function () {
    return ['name' => 'ANil'];
});

Route::get('wow', function () {
    return "Namastey";
});
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
