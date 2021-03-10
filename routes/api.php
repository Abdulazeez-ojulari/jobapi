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

////// Auth //////////

Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

////// Auth //////////

////// Job Api //////////

Route::get('jobs', 'App\Http\Controllers\JobsController@getAll');

Route::get('/jobs/{jobId}', 'App\Http\Controllers\JobsController@getByJobId');

Route::middleware('userauth')->get('/jobs/user/{userId}', 'App\Http\Controllers\JobsController@getByUserId');

Route::middleware('userauth')->post('jobs/{userId}', 'App\Http\Controllers\JobsController@create');

Route::middleware('userauth')->put('jobs/{jobId}', 'App\Http\Controllers\JobsController@update');

Route::middleware('userauth')->delete('jobs/{jobId}', 'App\Http\Controllers\JobsController@delete');

////// Job Api //////////

////// Job Application Api //////////

Route::post('/job-application', 'App\Http\Controllers\JobApplicationController@create');

Route::middleware('userauth')->get('/job-application/{jobId}/jobs', 'App\Http\Controllers\JobApplicationController@getByJobId');

Route::middleware('userauth')->get('/job-application/{jobApplicationId}', 'App\Http\Controllers\JobApplicationController@getById');

////// Job Application Api //////////