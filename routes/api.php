<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/result','SignupController@store');
Route::post('/check','SignupController@getData');
Route::post('/patient-data-add','SignupController@store');
Route::post('/patient-data','PatientsController@getDataForTable');
Route::post('/patient-data-post','PatientsController@store');

Route::get('/login', 'LoginController@getData');
Route::get('/user', 'UserPageController@getAllData');
Route::get('/data_for_table','PatientsController@getDataTable');
