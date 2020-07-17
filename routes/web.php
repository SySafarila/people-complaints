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
Route::get('/complaints/create', 'ComplaintsController@create')->name('complaints.create');
Route::get('/complaints/{complaint}', 'ComplaintsController@show')->name('complaints.show');
Route::get('/complaints/edit/{complaint}', 'ComplaintsController@edit')->name('complaints.edit');
// Complaints Post & etc
Route::post('/complaints', 'ComplaintsController@store')->name('complaints.store');
Route::post('/complaints/{complaint}', 'ComplaintsController@update')->name('complaints.update');
Route::post('/complaints/response/{complaint}', 'ComplaintsController@addResponse')->name('complaints.addResponse');
Route::delete('/complaints/{complaint}', 'ComplaintsController@destroy')->name('complaints.destroy');

// Files
Route::prefix('/files')->group(function () {
    Route::get('/photo/{fileName}', 'FilesController@photo')->name('get.photo');
});
