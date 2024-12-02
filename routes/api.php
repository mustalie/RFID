<?php

use App\Mail\ItemOut;
use App\Models\ItemMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::get('version', 'VersionAPIController@index');

/*
Route::resource('tags', App\Http\Controllers\API\TagAPIController::class);


Route::resource('tag_maps', App\Http\Controllers\API\TagMapAPIController::class);


Route::resource('checkins', App\Http\Controllers\API\CheckinAPIController::class);


Route::resource('student_presences', App\Http\Controllers\API\StudentPresenceAPIController::class);


Route::resource('rooms', App\Http\Controllers\API\RoomAPIController::class);
*/

Route::get('/test', function (Request $request) {
    $itemMovement = ItemMovement::find(9);
    Mail::to('lhuqita.fazry@ui.ac.id')->send(new ItemOut($itemMovement));
    echo "Sent";
});

Route::get('/rooms/kelas', 'RoomAPIController@kelas');
Route::get('/rooms/inventory', 'RoomAPIController@inventory');
Route::post('/presence/submit', 'StudentPresenceAPIController@submit');
Route::get('tags/get', 'TagAPIController@get');//->whereAlphaNumeric('tag', '[0-9]+');
Route::post('tags/pair', 'TagAPIController@pair');//->whereAlphaNumeric('tag', '[0-9]+');
Route::get('persediaan/autocomplete', 'PersediaanAPIController@autocomplete');//->whereAlphaNumeric('tag', '[0-9]+');
Route::get('student/autocomplete', 'MahasiswaAPIController@autocomplete');//->whereAlphaNumeric('tag', '[0-9]+');
Route::get('dosen/autocomplete', 'DosenAPIController@autocomplete');//->whereAlphaNumeric('tag', '[0-9]+');

Route::post('item_movements', 'ItemMovementAPIController@submit');//->whereAlphaNumeric('tag', '[0-9]+');
Route::get('device_rooms/get', 'DeviceRoomAPIController@get');
Route::post('device_rooms/save', 'DeviceRoomAPIController@save');
Route::get('inventory_groups', 'InventoryGroupAPIController@index');
Route::post('participan_tag','ParticipanTagAPIController@store');

//Route::resource('item_movements', App\Http\Controllers\API\ItemMovementAPIController::class);


//Route::resource('device_rooms', App\Http\Controllers\API\DeviceRoomAPIController::class);


//Route::resource('inventory_rooms', App\Http\Controllers\API\InventoryRoomAPIController::class);


//Route::resource('inventory_groups', App\Http\Controllers\API\InventoryGroupAPIController::class);


//Route::resource('inventory_details', App\Http\Controllers\API\InventoryDetailAPIController::class);
