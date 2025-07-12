<?php
use App\Http\Controllers\TripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/trips/search', [TripController::class, 'searchTrips']);
Route::get('/trips/{id}', [TripController::class, 'tripDetails']);


