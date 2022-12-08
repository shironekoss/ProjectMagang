<?php

use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SPKController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/testspk',[SPKController::class,'filternospk']);
Route::get('/latihan',[SPKController::class,'latihan']);
Route::get('/cobakoneksi', [SPKController::class,'coba']);

Route::get('/{any}', function () {
    return view('home');
})->where('any','.*');



// Route::get('/post/{slug}', [PostController::class, 'show']);

