<?php

use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\RuteController;
use App\Http\Controllers\Api\TerminalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('buses', [BusController::class, 'index']);
// Route::post('buses', [BusController::class, 'store']);
// Route::get('buses/{bus}', [BusController::class, 'show']);
// Route::put('buses/{bus}', [BusController::class, 'update']);
// Route::delete('buses/{bus}', [BusController::class, 'destroy']);
Route::apiResource('buses', BusController::class);
Route::apiResource('drivers', DriverController::class);
Route::apiResource('terminals', TerminalController::class);
Route::apiResource('rutes', RuteController::class);
Route::apiResource('jadwals', JadwalController::class);
