<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SPKController;
use App\Http\Controllers\SQLController;
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

Route::middleware('auth:sanctum')->get('/api/user', function (Request $request) {
    return $request->user();
});
Route::get('accounts',[SettingsController::class,'ambilaccounts']);
Route::get('products',[ProductController::class,'frontend']);
Route::get('users/{id}',[SettingsController::class,'show']);
Route::post('tambahaccount',[SettingsController::class,'addAccount']);

Route::delete('deleteaccount/{id}',[SettingsController::class,'removeaccount']);


//setting departemen
Route::get('showdepartemen',[SettingsController::class,'showdepartemen']);
Route::post('adddepartemen',[SettingsController::class,'adddepartemen']);
Route::post('saveuser',[SettingsController::class,'saveuser']);
Route::delete('hapusdepartemen{id}',[SettingsController::class,'hapusdepartemen']);
Route::delete('hapusstall{id}',[SettingsController::class,'hapusstall']);
Route::post('listdepartemen',[SettingsController::class,'getlistdepartemen']);
Route::get('liststall',[SettingsController::class,'getliststall']);
Route::post('getlistallparameter',[SettingsController::class,'getlistallparameter']);
Route::post('addstall',[SettingsController::class,'addstall']);
Route::post('updatestall',[SettingsController::class,'updatestall']);

Route::post('tambahSPK',[SPKController::class,'tambahSPK']);
Route::get('spklist',[SPKController::class,'spklist']);


Route::post('tambahmaster',[MasterController::class,'tambahmaster']);
Route::post('updatemaster',[MasterController::class,'updatemaster']);
Route::post('generatemasterkit',[MasterController::class,'generatemasterkit']);
Route::get('listmaster',[MasterController::class,'listmaster']);

Route::delete('hapusmaster{id}',[MasterController::class,'hapusmaster']);
Route::get('master/{id}',[MasterController::class,'carimaster']);

Route::post('listspkshow',[AdminController::class,'listspkshow']);
Route::post('checkfull',[AdminController::class,'checkfull']);
Route::get('getdatatable',[AdminController::class,'getdatatable']);
Route::post('getdatatable',[AdminController::class,'getdatatables']);
Route::post('getdatatablehistory',[AdminController::class,'getdatatablehistory']);
Route::post('getkode',[AdminController::class,'getkode']);
Route::post('ambilmax',[AdminController::class,'ambilmax']);
Route::post('admintambahspk',[AdminController::class,'admintambahspk']);
Route::post('konversikomponen',[AdminController::class,'konversikomponen']);
Route::post('konversisinglespk',[AdminController::class,'konversisinglespk']);
Route::post('konversicheckfull',[AdminController::class,'konversicheckfull']);
Route::post('getlistallparameterinput',[AdminController::class,'getlistallparameterinput']);
Route::delete('hapusdatatable{id}',[AdminController::class,'hapusdatatable']);

// Route::post('login',[LoginAuthController::class ,'loginfunction']);
Route::post('/login', [LoginAuthController::class,'loginfunction']);
Route::get('/logout', [LoginAuthController::class,'logout']);

Route::get('getdatakit',[SQLController::class,'getdatakit']);
Route::get('getdataspk',[SQLController::class,'getdataspk']);

// Route::resource('posts', PostController::class)->only([
//     'destroy', 'show', 'store', 'update'
//  ]);


