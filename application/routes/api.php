<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SPKController;
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
Route::post('tambahaccount',[SettingsController::class,'addAccount']);

Route::delete('deleteaccount/{id}',[SettingsController::class,'removeaccount']);

Route::post('tambahSPK',[SPKController::class,'tambahSPK']);
Route::get('spklist',[SPKController::class,'spklist']);

Route::post('tambahmaster',[MasterController::class,'tambahmaster']);
Route::post('generatemasterkit',[MasterController::class,'generatemasterkit']);

Route::get('listspkshow',[AdminController::class,'getdataspk']);
Route::get('getdatatable',[AdminController::class,'getdatatable']);
Route::post('getkode',[AdminController::class,'getkode']);
Route::post('ambilmax',[AdminController::class,'ambilmax']);
Route::post('admintambahspk',[AdminController::class,'admintambahspk']);
Route::post('konversikomponen',[AdminController::class,'konversikomponen']);
Route::delete('hapusdatatable{id}',[AdminController::class,'hapusdatatable']);

Route::post('login',[LoginAuthController::class ,'loginfunction']);

// Route::resource('posts', PostController::class)->only([
//     'destroy', 'show', 'store', 'update'
//  ]);


