<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ItemController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authentificated', function () {
    return true;
});


Route::post('register', [RegisterController::class, 'index']);
Route::post('login', [LoginController::class, 'index']);
Route::post('logout', [LoginController::class, 'logout']);

Route::get('items', [ItemController::class, 'index']);

Route::group(['prefix' => 'item'], function () {
    Route::post('add', [ItemController::class, 'store']);
    Route::get('edit/{id}', [ItemController::class, 'edit']);
    Route::get('show/{name}', [ItemController::class, 'show']);
    Route::post('update/{id}', [ItemController::class, 'update']);
    Route::delete('delete/{id}', [ItemController::class, 'destroy']);
});