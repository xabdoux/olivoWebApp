<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404)->header('Content-Type', 'application/json');
});

Route::post('login', 'ApiController@login');
//Route::post('register', 'ApiController@register');


Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');
    
    Route::resource('/clients', 'ApiInjecteurController');
    Route::get('/clients-deleted', 'ApiInjecteurController@deletedClients');
    Route::patch('/clients-restore/{id}', 'ApiInjecteurController@restoreClients');
    
});
