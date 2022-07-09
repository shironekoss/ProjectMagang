<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('users',[SettingsController::class,'ambiluser']);
Route::get('accounts',[SettingsController::class,'ambilaccounts']);
Route::get('products',[ProductController::class,'frontend']);
Route::get('users/{id}',[SettingsController::class,'show']);
Route::post('users',[SettingsController::class,'store']);

// Route::resource('posts', PostController::class)->only([
//     'destroy', 'show', 'store', 'update'
//  ]);


