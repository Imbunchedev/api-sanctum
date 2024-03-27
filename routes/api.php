<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\CountriesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('authenticate', [AuthController::class, 'login']);

Route::resource('player', PlayerController::class)->except(['create', 'edit'])->middleware('auth:sanctum');

Route::resource('positions', PositionsController::class)->except(['create', 'edit']);

Route::get('countries', [CountriesController::class, 'fetchDataFromApi']);


