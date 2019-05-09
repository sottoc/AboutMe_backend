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


Route::middleware('auth:api')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Route::resource('cities', 'API\CityController')->except(['index']);
    
    // Route::post('/cities/insertmany', 'API\CityController@insertMany');
    
});

//Route::resource('cities', 'API\CityController')->only(['index']);
Route::post('/upload', 'API\UploadController@upload');
Route::post('/email_check', 'API\UtilityController@checkEmail');
Route::post('/username_check', 'API\UtilityController@checkUsername');