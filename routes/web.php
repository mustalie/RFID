<?php

use Illuminate\Support\Facades\Route;
use App\Models\Persediaan;

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

Route::get('/', function () {
    echo 'OK';
});

//Auth::routes();

/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('tags', App\Http\Controllers\TagController::class);


Route::resource('tagMaps', App\Http\Controllers\TagMapController::class);


Route::resource('checkins', App\Http\Controllers\CheckinController::class);


Route::resource('studentPresences', App\Http\Controllers\StudentPresenceController::class);


Route::resource('rooms', App\Http\Controllers\RoomController::class); */


//Route::resource('itemMovements', App\Http\Controllers\ItemMovementController::class);


//Route::resource('deviceRooms', App\Http\Controllers\DeviceRoomController::class);


//Route::resource('inventoryRooms', App\Http\Controllers\InventoryRoomController::class);


//Route::resource('inventoryGroups', App\Http\Controllers\InventoryGroupController::class);


//Route::resource('inventoryDetails', App\Http\Controllers\InventoryDetailController::class);
