<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

// Complaints Get
Route::get('/complaints', 'ComplaintsController@index')->name('complaints.index');
Route::get('/complaints/on-process', 'ComplaintsController@onProcess')->name('complaints.onProcess');
Route::get('/complaints/complete', 'ComplaintsController@complete')->name('complaints.complete');
Route::get('/complaints/create', 'ComplaintsController@create')->name('complaints.create');
Route::get('/complaints/{complaint}', 'ComplaintsController@show')->name('complaints.show');
Route::get('/complaints/edit/{complaint}', 'ComplaintsController@edit')->name('complaints.edit');
Route::get('/complaints/edit/photo/{complaint}', 'ComplaintsController@editPhoto')->name('complaints.editPhoto');
// Complaints Post & etc
Route::post('/complaints', 'ComplaintsController@store')->name('complaints.store');
Route::post('/complaints/{complaint}', 'ComplaintsController@update')->name('complaints.update');
Route::post('/complaints/photo/{complaint}', 'ComplaintsController@updatePhoto')->name('complaints.updatePhoto');
Route::post('/complaints/response/{complaint}', 'ComplaintsController@addResponse')->name('complaints.addResponse');
Route::post('/complaints/status/{complaint}', 'ComplaintsController@setStatus')->name('complaints.setStatus');
Route::delete('/complaints/{complaint}', 'ComplaintsController@destroy')->name('complaints.destroy');

// Files
Route::prefix('/files')->group(function () {
    Route::get('/photo/{fileName}', 'FilesController@photo')->name('get.photo');
});

// Responses
Route::get('/complaint/{complaint}/response/{response}', 'ResponsesController@edit')->name('responses.edit');

Route::post('/complaint/{complaint}/response/{response}', 'ResponsesController@update')->name('response.update');

// Users
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/{user}', 'UsersController@show')->name('users.show');

Route::post('/users/{user}', 'UsersController@update')->name('users.update');
